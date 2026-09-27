<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ChatbotCategory;
use App\Models\ChatbotKnowledge;
use App\Models\ChatbotSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function widget()
    {
        $settings = ChatbotSetting::first();
        return view('layouts.pages.chatbot_widget', [
            'settings' => $settings,
            'knowledgeCategories' => ChatbotCategory::pluck('name'),
            'providers' => collect(config('ai.providers'))->map(fn($p) => [
                'name' => $p['name'] ?? '',
                'enabled' => $p['enabled'] ?? false
            ])
        ]);
    }

    public function chat(Request $request)
    {
        $request->validate([
            'messages' => 'required|array|min:1',
            'messages.*.role' => 'required|string',
            'messages.*.content' => 'required|string|max:5000'
        ]);

        try {
            $settings = ChatbotSetting::first();

            if ($settings && !$settings->enabled) {
                return response()->json([
                    'success' => false,
                    'message' => 'Chatbot is currently disabled.'
                ], 503);
            }

            $providers = config('ai.providers');
            $preferred = $settings?->preferred_provider ?? 'auto';
            $order = $this->getProviderOrder($providers, $preferred);

            if (empty($order)) {
                return response()->json([
                    'success' => false,
                    'message' => 'AI service unavailable.'
                ], 503);
            }

            $messages = $request->messages;
            $user = collect($messages)->reverse()->firstWhere('role', 'user');
            $question = $this->sanitizeQuery($user['content'] ?? '');
            $knowledge = $this->searchKnowledge($question);

            if ($knowledge->isEmpty() || $this->isBroadQuery($question)) {
                $knowledge = $this->getCoreKnowledge();
            }

            $system = $this->buildSystemPrompt($settings, $knowledge);

            foreach ($order as $name) {
                try {
                    $reply = $this->callProvider(
                        $name,
                        $providers[$name],
                        $messages,
                        $system,
                        $settings
                    );

                    return response()->json([
                        'success' => true,
                        'reply' => $reply,
                        'knowledge_used' => $knowledge->isNotEmpty(),
                        'provider' => $name
                    ]);
                } catch (\Throwable $e) {
                    Log::warning('Chatbot provider failed', [
                        'provider' => $name,
                        'message' => $e->getMessage()
                    ]);

                    if (!$this->shouldFallback($e)) {
                        throw $e;
                    }
                }
            }

            throw new \Exception('All configured AI providers are currently unavailable.');

        } catch (\Throwable $e) {
            Log::error('Chatbot error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'success' => false,
                'message' => config('app.debug')
                    ? $e->getMessage()
                    : 'Sorry, I could not process that request.'
            ], 500);
        }
    }

    private function getProviderOrder($providers, $preferred)
    {
        $defaultOrder = [
            'gemini',
            'groq',
            'openrouter',
            'openai',
            'deepseek'
        ];

        $available = collect($defaultOrder)
            ->filter(fn($name) =>
                isset($providers[$name]) &&
                ($providers[$name]['enabled'] ?? false) &&
                !empty($providers[$name]['api_key'])
            )
            ->values()
            ->all();

        if ($preferred !== 'auto' && in_array($preferred, $available)) {
            $available = array_values(array_unique(
                array_merge([$preferred], $available)
            ));
        }

        return $available;
    }

    private function shouldFallback(\Throwable $e)
    {
        $message = strtolower($e->getMessage());

        return str_contains($message, '400') ||
            str_contains($message, '401') ||
            str_contains($message, '403') ||
            str_contains($message, '429') ||
            str_contains($message, 'api_key_invalid') ||
            str_contains($message, 'api key not valid') ||
            str_contains($message, 'invalid api key') ||
            str_contains($message, 'rate limit') ||
            str_contains($message, 'quota') ||
            str_contains($message, 'resource exhausted') ||
            str_contains($message, 'too many requests') ||
            str_contains($message, '502') ||
            str_contains($message, '503') ||
            str_contains($message, '504') ||
            str_contains($message, 'timeout') ||
            str_contains($message, 'timed out') ||
            str_contains($message, 'connection') ||
            str_contains($message, 'temporarily unavailable') ||
            str_contains($message, 'service unavailable');
    }

    private function buildSystemPrompt($settings, $knowledge)
    {
        $prompt = "You are the official AI assistant for Magino Daniel's portfolio.\n";
        $prompt .= "You represent and work for Magino Daniel, but you are not Magino Daniel himself.\n\n";
        $prompt .= "When asked who you are, say you are Magino Daniel's portfolio AI assistant.\n";
        $prompt .= "When asked who you work for, say you work for Magino Daniel.\n";
        $prompt .= "Answer questions about Magino Daniel using the Knowledge Base below.\n\n";
        $prompt .= "The Knowledge Base is your source of truth. Never invent facts, skills, education, experience, projects, services, employers, dates or qualifications.\n";
        $prompt .= "If the information is not available, clearly say it is not currently available in the portfolio Knowledge Base.\n\n";
        $prompt .= "Be natural, friendly and professional. Keep answers concise unless the user requests detail.\n\n";

        if ($settings?->system_prompt) {
            $prompt .= "Additional instructions:\n{$settings->system_prompt}\n\n";
        }

        return $prompt . "KNOWLEDGE BASE:\n" . $this->knowledgeContext($knowledge);
    }

    private function knowledgeContext($knowledge)
    {
        return $knowledge->map(fn($item) =>
            "Category: " . ($item->category?->name ?? 'General') .
            "\nTopic: {$item->title}" .
            "\nInformation: {$item->content}"
        )->implode("\n\n");
    }

    private function callProvider($name, $provider, $messages, $system, $settings)
    {
        $model = $provider['default_model']
            ?? array_key_first($provider['models'] ?? []);

        if (empty($provider['api_key'])) {
            throw new \Exception("{$name} API key is not configured.");
        }

        if (empty($model)) {
            throw new \Exception("{$name} model is not configured.");
        }

        if ($name === 'gemini') {
            return $this->callGemini(
                $provider,
                $model,
                $messages,
                $system,
                $settings
            );
        }

        return $this->callOpenAICompatibleProvider(
            $provider,
            $model,
            $messages,
            $system,
            $settings
        );
    }

    private function callGemini($provider, $model, $messages, $system, $settings)
    {
        $contents = collect($messages)
            ->reject(fn($m) => $m['role'] === 'system')
            ->map(fn($m) => [
                'role' => $m['role'] === 'assistant' ? 'model' : 'user',
                'parts' => [['text' => $m['content']]]
            ])->values()->all();

        $url = str_replace(':model', $model, $provider['url']);

        $response = Http::timeout(30)
            ->withHeaders([
                'x-goog-api-key' => $provider['api_key']
            ])
            ->post($url, [
                'systemInstruction' => [
                    'parts' => [['text' => $system]]
                ],
                'contents' => $contents,
                'generationConfig' => [
                    'temperature' => $settings?->temperature ?? 0.4,
                    'maxOutputTokens' => $settings?->max_tokens ?? 500
                ]
            ]);

        if (!$response->successful()) {
            throw new \Exception(
                'Gemini API error (' . $response->status() . '): ' . $response->body()
            );
        }

        $reply = data_get(
            $response->json(),
            'candidates.0.content.parts.0.text'
        );

        if (!$reply) {
            throw new \Exception('Gemini returned an empty response.');
        }

        return $reply;
    }

    private function callOpenAICompatibleProvider(
        $provider,
        $model,
        $messages,
        $system,
        $settings
    ) {
        $response = Http::timeout(30)
            ->withToken($provider['api_key'])
            ->post($provider['url'], [
                'model' => $model,
                'messages' => array_merge(
                    [['role' => 'system', 'content' => $system]],
                    $messages
                ),
                'temperature' => $settings?->temperature ?? 0.4,
                'max_tokens' => $settings?->max_tokens ?? 300
            ]);

        if (!$response->successful()) {
            throw new \Exception(
                'AI provider error (' . $response->status() . '): ' . $response->body()
            );
        }

        $reply = data_get(
            $response->json(),
            'choices.0.message.content'
        );

        if (!$reply) {
            throw new \Exception('AI provider returned an empty response.');
        }

        return $reply;
    }

    public function query(Request $request)
    {
        $request->validate(['query' => 'required|string|max:500']);

        $query = $this->sanitizeQuery($request->input('query'));

        return response()->json([
            'success' => true,
            'query' => $query,
            'knowledge' => $this->prepareResponse(
                $this->searchKnowledge($query)
            )
        ]);
    }

    private function searchKnowledge($query)
    {
        if ($this->isGreeting($query) || $this->isBroadQuery($query)) {
            return $this->getCoreKnowledge();
        }

        $keywords = $this->extractKeywords($query);

        if (!$keywords) {
            return collect();
        }

        return ChatbotKnowledge::with('category')
            ->where('status', 'active')
            ->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('title', 'like', "%{$word}%")
                        ->orWhere('content', 'like', "%{$word}%")
                        ->orWhere('keywords', 'like', "%{$word}%");
                }
            })
            ->limit(15)
            ->get();
    }

    private function getCoreKnowledge($limit = 20)
    {
        return ChatbotKnowledge::with('category')
            ->where('status', 'active')
            ->orderBy('id')
            ->limit($limit)
            ->get();
    }

    private function prepareResponse($items)
    {
        return $items->map(fn($item) => [
            'title' => $item->title,
            'category' => $item->category?->name,
            'content' => $item->content
        ])->values();
    }

    private function isGreeting($query)
    {
        return preg_match(
            '/^(hi|hello|hey|good morning|good afternoon|good evening|how are you)\b/i',
            trim($query)
        );
    }

    private function isBroadQuery($query)
    {
        return preg_match(
            '/^(who\s+is|who\s+are|what\s+does|what\s+do\s+you\s+do|who\s+do\s+you\s+work\s+for|who\s+are\s+you|tell\s+me\s+about|about)\b/i',
            trim($query)
        );
    }

    private function extractKeywords($query)
    {
        $stop = [
            'the','a','an','is','are','was','were','what','who','how','where',
            'when','why','can','could','would','should','do','does','did',
            'tell','me','about','please','and','or','of','to','for','in','on',
            'with','his','her','he','she','you'
        ];

        return collect(preg_split('/\s+/', strtolower($query)))
            ->map(fn($word) => preg_replace('/[^a-z0-9\-]/', '', $word))
            ->filter(fn($word) => strlen($word) > 2 && !in_array($word, $stop))
            ->unique()
            ->values()
            ->all();
    }

    private function sanitizeQuery($query)
    {
        return trim(preg_replace('/\s+/', ' ', strip_tags($query)));
    }
}