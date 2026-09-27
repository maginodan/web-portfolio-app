<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'logo_light',
        'logo_dark',
        'favicon',
        'footer_text',
        'hcaptcha_site_key',
        'hcaptcha_secret_key',
        'hcaptcha_enabled',
        'primary_color',
        'cookie_consent_enabled',
        'cookie_consent_text',
        'cookie_accept_text',
        'cookie_decline_text',
        'cookie_privacy_text',
        'cookie_privacy_url',
    ];

    protected $casts = [
        'hcaptcha_enabled' => 'boolean',
        'cookie_consent_enabled' => 'boolean',
    ];
}