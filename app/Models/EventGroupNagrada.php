<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGroupNagrada extends Model
{
    use HasFactory;

    protected $table = 'event_group_nagradas';

    protected $fillable = ['name', 'event_id'];

    // Связь с мероприятием (один к одному или один ко многим с Event)
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
