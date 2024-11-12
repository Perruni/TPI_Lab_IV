<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitacion extends Model
{
    use HasFactory;

    protected $table = 'invitaciones';

    protected $fillable = [
        'user_id',
        'event_id', 
        'estado', 
        'fecha'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function aceptar()
    {
        $this->update(['estado' => 'aceptada']);
        $this->delete();
    }

    public function rechazar()
    {
        $this->update(['estado' => 'rechazada']);
        $this->delete();
    }
}