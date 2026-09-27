<?php


/*
|--------------------------------------------------------------------------
| AI Service Providers Configuration
|--------------------------------------------------------------------------
|
| This file contains the configuration for all AI service providers used
| by the chatbot. Each provider can be enabled/disabled via environment
| variables and requires an API key to function. The 'preferred_provider'
| setting in the admin panel determines which provider is used first,
| with automatic fallback to other enabled providers.
|
| Supported Providers: Gemini, Groq, OpenAI, OpenRouter, DeepSeek
|
*/

return [
    'providers' => [
        'gemini' => [
            'name' => 'Google Gemini',
            'enabled' => env('GEMINI_ENABLED', true),
            'api_key' => env('GEMINI_API_KEY'),
            'url' => 'https://generativelanguage.googleapis.com/v1beta/models/:model:generateContent?key=:key',
            'models' => [
                'gemini-3.6-flash' => 'Gemini 3.6 Flash',
                'gemini-3.5-flash-lite' => 'Gemini 3.5 Flash-Lite',
            ],
            'default_model' => 'gemini-3.5-flash-lite',
        ],
        'groq' => [
            'name' => 'Groq',
            'enabled' => env('GROQ_ENABLED', true),
            'api_key' => env('GROQ_API_KEY'),
            'url' => 'https://api.groq.com/openai/v1/chat/completions',
            'models' => [
                'qwen/qwen3.8-27b' => 'Qwen 3.8 27B',
                'qwen/qwen3.6-27b' => 'Qwen 3.6 27B',
                'openai/gpt-oss-20b' => 'GPT OSS 20B',
                'openai/gpt-oss-120b' => 'GPT OSS 120B',
            ],
            'default_model' => 'qwen/qwen3.8-27b',
        ],
        'openai' => [
            'name' => 'OpenAI',
            'enabled' => env('OPENAI_ENABLED', false),
            'api_key' => env('OPENAI_API_KEY'),
            'url' => 'https://api.openai.com/v1/chat/completions',
            'models' => [
                'gpt-4' => 'GPT-4',
                'gpt-4-turbo' => 'GPT-4 Turbo',
                'gpt-3.5-turbo' => 'GPT-3.5 Turbo',
            ],
            'default_model' => 'gpt-3.5-turbo',
        ],
        'openrouter' => [
            'name' => 'OpenRouter (Free)',
            'enabled' => env('OPENROUTER_ENABLED', false),
            'api_key' => env('OPENROUTER_API_KEY'),
            'url' => 'https://openrouter.ai/api/v1/chat/completions',
            'models' => [
                'openrouter/free' => 'OpenRouter Free',
            ],
            'default_model' => 'openrouter/free',
        ],
        'deepseek' => [
            'name' => 'DeepSeek',
            'enabled' => env('DEEPSEEK_ENABLED', false),
            'api_key' => env('DEEPSEEK_API_KEY'),
            'url' => 'https://api.deepseek.com/v1/chat/completions',
            'models' => [
                'deepseek-chat' => 'DeepSeek Chat',
                'deepseek-coder' => 'DeepSeek Coder',
            ],
            'default_model' => 'deepseek-chat',
        ],
    ],
];