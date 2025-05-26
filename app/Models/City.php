<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
//    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'country_id',
    ];

    // Связь с моделью Country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
