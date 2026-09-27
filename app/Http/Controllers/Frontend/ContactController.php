<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\Models\Message;
use App\Models\SiteSetting;
use App\Mail\NewContactMessage;
use App\Rules\ValidHCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $siteSetting = SiteSetting::first();

        $rules = [
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'subject'     => 'required|string|max:255',
            'description' => 'required|string',
        ];

        if ($siteSetting?->hcaptcha_enabled && $siteSetting?->hcaptcha_site_key) {
            $rules['h-captcha-response'] = ['required', new ValidHCaptcha()];
        }

        $validated = $request->validate($rules);

        // Demo mode: validate normally, but don't actually store or email anything
        if (config('app.demo')) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'demo' => true,
                    'message' => 'Demo mode: This site is running in demo mode, so messages cannot be sent.',
                ]);
            }

            return redirect('/')->with('info', 'This site is running in demo mode, so messages cannot be sent.');
        }

        // h-captcha-response isn't a Message column — strip it before saving
        unset($validated['h-captcha-response']);

        $validated['status'] = 0;

        // Save message
        $message = Message::create($validated);

        // Send notification to admin
        Mail::to(env('MAIL_ADMIN_ADDRESS'))
            ->send(new NewContactMessage($message));

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully!',
            ]);
        }

        return redirect('/')->with('success', 'Message Sent Successfully!');
    }
}