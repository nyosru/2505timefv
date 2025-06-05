<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventParticipant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'athlete_id',
        'event_id',
        'place',
    ];

    // Связь с участником (спортсменом)
    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }

    // Связь с мероприятием
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
