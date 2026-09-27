<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'description',
    ];

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}