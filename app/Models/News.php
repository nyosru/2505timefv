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
        'user_autor_id',
        'photo'
    ];
    protected $casts = [
        'date' => 'date',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }

    public function userAutor()
    {
        return $this->belongsTo(User::class, 'user_autor_id');
    }

}
