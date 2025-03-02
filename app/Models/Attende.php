<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attende extends Model
{
    use HasFactory;
    protected $table = 'attendes';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'event_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class); // Un partecipante appartiene a un evento
    }
}
