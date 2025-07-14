<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'logo'];


    // Новости данного вида спорта
    public function news()
    {
        return $this->belongsToMany(News::class, 'news_sport_type');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_sport_type');
    }

}
