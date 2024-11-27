<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permisos';

    protected $fillable = [
        'user_id',
        'event_id',
        'asistencia',
        'verEvento',
        'invitar',
        'eliminarIvitado',
        'modificar',
        'eliminarEvento',
        'darPermisos',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'event_id');
    }
}
