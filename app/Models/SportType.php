<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'logo'];

    // Мероприятия данного вида спорта
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    // Новости данного вида спорта
    public function news()
    {
        return $this->belongsToMany(News::class, 'news_sport_type');
    }


}
