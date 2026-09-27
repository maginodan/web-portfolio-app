<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotSetting;
use Illuminate\Http\Request;

class ChatbotSettingsController extends Controller
{
    public function index()
    {   
        $settings = ChatbotSetting::first() ?? new ChatbotSetting([
            'system_prompt'      => '',
            'welcome_message'    => '',
            'preferred_provider' => 'auto',
            'temperature'        => 0.4,
            'max_tokens'         => 300,
            'enabled'            => true,
        ]);
        $providers = config('ai.providers');
        $enabledProviders = array_filter($providers, function($provider) {
            return $provider['enabled'] && $provider['api_key'];
        });

        return view('admin.chatbot.settings.index', compact('settings', 'providers', 'enabledProviders'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'welcome_message'     => 'nullable|string',
            'preferred_provider'  => 'required|string',
            'temperature'         => 'required|numeric|min:0|max:2',
            'max_tokens'          => 'required|integer|min:1',
            'system_prompt'       => 'required|string',
            'enabled'             => 'required|boolean',
        ]);

        $settings = ChatbotSetting::firstOrCreate(['id' => 1]);

        $settings->update([
            'welcome_message'     => $request->welcome_message,
            'preferred_provider'  => $request->preferred_provider,
            'temperature'         => $request->temperature,
            'max_tokens'          => $request->max_tokens,
            'system_prompt'       => $request->system_prompt,
            'enabled'             => $request->enabled,
        ]);

        return redirect()->back()->with('flash_message', 'Chatbot settings updated successfully.');
    }
}