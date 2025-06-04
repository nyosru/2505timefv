<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventAttachment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'event_id',
        'name',
        'filename',
        'image_mini',
        's3_url',
        'type',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
