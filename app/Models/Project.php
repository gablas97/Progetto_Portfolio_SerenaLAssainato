<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'location',
        'images',
        'videos',
        'execution_year',
        'categories',
    ];

    protected $casts = [
        'title' => 'array',
        'subtitle' => 'array',
        'description' => 'array',
        'location' => 'array',
        'images' => 'array',
        'videos' => 'array',
        'execution_year' => 'integer',
        'categories' => 'array',
    ];
}
