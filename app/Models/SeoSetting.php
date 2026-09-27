<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_author',
        'og_image',
        'twitter_handle',
        'canonical_url',
    ];
}