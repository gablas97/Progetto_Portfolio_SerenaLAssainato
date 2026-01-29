<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insight extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
        'images',
        'videos',
        'categories',
        'type',
        'visit_link',
    ];

    protected $casts = [
        'date' => 'date',
        'title' => 'array',
        'description' => 'array',
        'images' => 'array',
        'videos' => 'array',
        'categories' => 'array',
    ];
}
