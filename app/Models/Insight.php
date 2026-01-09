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
        'images' => 'array',
        'categories' => 'array',
    ];
}
