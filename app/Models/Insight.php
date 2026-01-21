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
        'categories',
        'type',
        'visit_link',
    ];

    protected $casts = [
        'date' => 'date',
        'title' => 'array',
        'description' => 'array',
        'images' => 'array',
        'categories' => 'array',
    ];
}
