<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'short_text',
        'full_text',
        'event_id',
        'athlete_id',
    ];
    protected $casts = [
        'date' => 'date',
    ];
}
