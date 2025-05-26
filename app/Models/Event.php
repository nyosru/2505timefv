<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'event_date',
        'country',
        'city',
        'venue',
        'description',
        'photo',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

}
