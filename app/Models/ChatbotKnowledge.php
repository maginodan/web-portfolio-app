<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ChatbotCategory;

class ChatbotKnowledge extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category_id',
        'keywords',
        'status',
    ];

    /**
     * Each knowledge entry belongs to a category
     */
    public function category()
    {
        return $this->belongsTo(ChatbotCategory::class, 'category_id');
    }
}