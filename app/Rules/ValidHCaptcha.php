<?php

namespace App\Rules;

use Closure;
use App\Models\SiteSetting;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class ValidHCaptcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 1. Retrieve secret key directly from database
        $setting = SiteSetting::first();
        $secretKey = $setting?->hcaptcha_secret_key;

        // If no secret key is configured in Admin, fail gracefully
        if (!$secretKey) {
            $fail('hCaptcha is not configured properly in admin settings.');
            return;
        }

        // 2. Verify response with hCaptcha API
        $response = Http::asForm()->post('https://api.hcaptcha.com/siteverify', [
            'secret'   => $secretKey,
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        if (!$response->successful() || !$response->json('success')) {
            $fail('The CAPTCHA verification failed. Please try again.');
        }
    }
}
