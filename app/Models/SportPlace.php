<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportPlace extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'city_id',
        'name',
        'photo',
        'photo_s3_url',
    ];

    // Связь с городом
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Все мероприятия, связанные с этим спортивным местом
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

}
