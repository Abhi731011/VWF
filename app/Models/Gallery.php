<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'images',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'images' => 'array',
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];
}
