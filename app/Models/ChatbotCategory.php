<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ChatbotKnowledge;

class ChatbotCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    public function knowledge()
    {
        return $this->hasMany(ChatbotKnowledge::class, 'category_id');
    }
}