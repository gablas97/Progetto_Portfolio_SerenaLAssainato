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
        'images' => 'array',
        'execution_year' => 'integer',
        'categories' => 'array',
    ];
}
