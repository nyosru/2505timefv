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
        'country',
        'city',
        'venue',
        'description',
        'photo',
        'sport_type_id',
    ];

    protected $casts = [
        'event_date' => 'date',
        'events_date_finished' => 'date',
    ];

    // Связь с видом спорта
    public function sportType()
    {
        return $this->belongsTo(SportType::class);
    }

    /**
     * Связь с моделью SportPlace (спортивное место)
     */
    public function sportPlace()
    {
        return $this->belongsTo(SportPlace::class);
    }

}
