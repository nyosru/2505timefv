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
        'events_date_finished',

        'description',
        'photo',

        'country_id',
        'city_id',
        'sport_place_id',

    ];

    protected $casts = [
        'event_date' => 'date',
        'events_date_finished' => 'date',
    ];


    /**
     * Связь с моделью SportPlace (спортивное место)
     */
    public function sportPlace()
    {
        return $this->belongsTo(SportPlace::class);
    }

    /**
     * Все участники данного мероприятия
     */
    public function participants()
    {
        return $this->hasMany(EventParticipant::class);
    }

//    public function guests()
//    {
//        return $this->belongsToMany(Guest::class, 'event_guests')
//            ->using(EventGuest::class)
//            ->withTimestamps();
//    }

//    public function guests()
//    {
//        return $this->hasMany(EventGuest::class);
//    }


    public function guests()
    {
        return $this->belongsToMany(Guest::class, 'event_guests')
//            ->using(EventGuest::class)
//            ->withTimestamps()
            ;
    }

    public function athletes()
    {
        return $this->belongsToMany(Athlete::class, 'event_participants');
    }

    public function athletesNoPlace()
    {
        return $this->belongsToMany(Athlete::class, 'event_participants');
    }

    public function attachments()
    {
        return $this->hasMany(EventAttachment::class);
    }

    public function photos()
    {
        return $this->hasMany(EventAttachment::class)->where('type', 'image');
    }

    public function videos()
    {
        return $this->hasMany(EventAttachment::class)->where('type', 'video');
    }

    public function docs()
    {
        return $this->hasMany(EventAttachment::class)->where('type', 'document');
    }

    public function publication()
    {
        return $this->hasMany(EventAttachment::class)->where('type', 'publication');
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class, 'event_sponsor')
            ->withTimestamps();
    }


    // Группы наград мероприятия (один ко многим)
    public function groupsNagrada()
    {
        return $this->hasMany(EventGroupNagrada::class);
    }

    /**
     * Новости, связанные с этим спортсменом
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }
    /**
     * Виды спорта, связанные с мероприятием
     */
    public function sportTypes()
    {
        return $this->belongsToMany(SportType::class, 'event_sport_type');
    }

}
