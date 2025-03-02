<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';

    // Colonne che possono essere riempite tramite mass-assignment
    protected $fillable = [
        'title',
        'description',
        'scheduled_at',
        'location',
        'max_attendees',
    ];

    // Definizione della relazione con i partecipanti
    public function attendees()
    {
        return $this->hasMany(Attendee::class); // Un evento può avere molti partecipanti
    }
}
