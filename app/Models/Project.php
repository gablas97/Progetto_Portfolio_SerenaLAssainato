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
        'execution_year',
        'categories',
    ];

    protected $casts = [
        'title' => 'array',
        'subtitle' => 'array',
        'description' => 'array',
        'location' => 'array',
        'images' => 'array',
        'execution_year' => 'integer',
        'categories' => 'array',
    ];
}
