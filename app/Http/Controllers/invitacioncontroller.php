<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\evento;
use App\Models\Permiso;
use App\Models\User;
use App\Models\User_roles;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Models\Invitacion;
use Illuminate\Http\Request;
use App\Models\Notificacion;

class invitacioncontroller extends Controller
{
    public function invitar($eventoId,)
    {

        $userId = Auth::id();
    
        $esPropietario = Evento::where('id', $eventoId)
                        ->where('user_id', $userId)
                        ->exists();

        $tienePermisoInvitar = Permiso::where('user_id', $userId)
                            ->where('event_id', $eventoId)
                            ->where('invitar', true)
                            ->exists();

        if ($esPropietario || $tienePermisoInvitar) {
            return view('invitar', compact('eventoId'));
        }

        abort(403, 'No tienes permiso para invitar a este evento.');

    }

    public function buscarinvitados(Request $request)
    {
        $search = $request->search;
        $eventoId = $request->input('eventoId');

        $evento = Evento::findOrFail($eventoId);
        $eventoOwnerId = $evento->user_id;

        $permisosIds = Permiso::where('event_id', $eventoId)->pluck('user_id');

        $invitadosIds = Invitacion::where('event_id', $eventoId)->pluck('user_id');


        $usuariosInvitados = User_roles::where('invitado', true)->pluck('user_id');

        $users = User::where(function($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        })
            ->whereNotIn('id', $invitadosIds)
            ->whereNotIn('id', $permisosIds)
            ->whereIn('id', $usuariosInvitados)
            ->where('id', '<>', $eventoOwnerId)
            ->get();

            return view('invitar', compact('users', 'eventoId'));
    }

    public function enviarinvitacion(Request $request)
    {
        $userId = Auth::id();
        $eventoId = $request->input('eventoId');
        $invitadoId = $request->input('usuario_id');

        $evento = Evento::findOrFail($eventoId);

        $esPropietario = Evento::where('id', $eventoId)
                        ->where('user_id', $userId)
                        ->exists();

        $tienePermiso = Permiso::where('user_id', $userId)
                            ->where('event_id', $eventoId)
                            ->where('invitar', true)
                            ->exists();

                            
        if (!$tienePermiso && !$esPropietario) {
            abort(403, 'No tienes permiso para invitar a este evento.');
        }

        $Invitado = Invitacion::where('user_id', $invitadoId)
                                ->where('event_id', $eventoId)
                                ->exists();

        if ($Invitado) {
            return redirect()->route('invitar', ['eventoId' => $eventoId])
                             ->with('error', 'Este usuario ya ha sido invitado.');
        }

        Invitacion::create([
            'user_id' => $invitadoId,
            'event_id' => $eventoId,
            'fecha' => now(),
        ]);

        Permiso::create([
            'user_id' => $invitadoId,
            'event_id' => $eventoId,
            'asistencia'=> 'pendiente',            
            'verEvento'=> false,
            'invitar'=> false,
            'eliminarIvitado'=> false,
            'modificar'=> false,
            'eliminarEvento'=> false,
        ]);

        Notificacion::create([
            'user_id' => $invitadoId,
            'evento_id' => $eventoId,
            'mensaje' => 'Has sido invitado al evento ' . $evento->nombreEvento,
        ]);

        return redirect()->route('invitar', ['eventoId' => $eventoId])
                         ->with('success', 'Invitación enviada correctamente.');
    }
}
