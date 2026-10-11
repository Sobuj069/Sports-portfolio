<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'series',
        'date_string',
        'race_time',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'race_time' => 'datetime',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
