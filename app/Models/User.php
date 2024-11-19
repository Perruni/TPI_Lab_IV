<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function permisos()
    {
        return $this->hasMany(Permiso::class);
    }

    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'permisos')
                    ->withPivot(['asistencia', 'verEvento', 'invitar', 'eliminarIvitado', 'modificar', 'eliminarEvento', 'darPermisos'])
                    ->withTimestamps();
    }
    
    public function userRole(): HasOne
    {
        return $this->hasOne(user_roles::class);
    }
}
