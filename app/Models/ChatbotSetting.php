<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotSetting extends Model
{
    protected $fillable = [
        'system_prompt',
        'welcome_message',
        'preferred_provider',
        'temperature',
        'max_tokens',
        'enabled',
    ];
}
