<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'images',
        'execution_date',
        'categories',
    ];

    protected $casts = [
        'execution_date' => 'date',
        'images' => 'array', // Cast automatico da JSON a array
        'categories' => 'array', // Cast automatico da JSON a array
    ];
}
