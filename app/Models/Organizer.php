<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organizer extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'city_id', 'address', 'logo', 'website'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
