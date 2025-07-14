<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Athlete extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'photo',
        'birth_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];


    /**
     * Все участия данного спортсмена в мероприятиях
     */
    public function eventParticipants()
    {
        return $this->hasMany(EventParticipant::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_participants');
    }

    public function groupsNagrada()
    {
        return $this->belongsToMany(EventGroupNagrada::class, 'event_participants', 'athlete_id', 'event_group_nagrada_id')
            ->withPivot('event_id', 'place')
            ->withTimestamps();
    }

    /**
     * Новости, связанные с этим спортсменом
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }

}
