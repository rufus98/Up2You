<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'scheduled_at',
        'location',
        'max_attendees',
    ];

    public function attendees()
    {
        return $this->hasMany(Attendee::class); 
    }
}
