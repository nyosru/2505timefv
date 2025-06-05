<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sponsor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name',
        'last_name',
        'first_name',
        'middle_name',
        'comment',
        'link',
        'photo',
        'birth_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_sponsor')
            ->withTimestamps();
    }

}
