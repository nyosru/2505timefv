<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'comment',
        'photo',
        'birth_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];


    /**
     * Все участия данного спортсмена в мероприятиях
     */
    public function eventGuests()
    {
        return $this->hasMany(EventGuest::class);
    }

//    public function events()
//    {
//        return $this->belongsToMany(Event::class, 'event_participants');
//    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_guests')
            ->using(EventGuest::class)
            ->withTimestamps();
    }

}
