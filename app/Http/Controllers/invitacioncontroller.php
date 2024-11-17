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
            return view('invitar', ['eventoId' => $eventoId]);
        }

        abort(403, 'No tienes permiso para invitar a este evento.');

    }

    public function buscarinvitados(Request $request)
    {
        $search = $request->search;

        $eventoId = $request->input('eventoId');
        $evento = Evento::findOrFail($eventoId);
        $eventoOwnerId = $evento->user_id;

        $userId = Auth::id();
        $userRol= User_roles::where('user_id', $userId)->first();

        $permisosIds = Permiso::where('event_id', $eventoId)->pluck('user_id');

        $invitadosIds = Invitacion::where('event_id', $eventoId)->pluck('user_id');

        $usuariosInvitados = User_roles::where('invitado', true)->pluck('user_id');

        $usuariosOrganizadores = User_roles::where('organizador', true)->pluck('user_id');

        if ($userRol->organizador) {
            $users = User::where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
            })
                ->whereNotIn('id', $invitadosIds)
                ->whereNotIn('id', $permisosIds)
                ->whereIn('id', $usuariosInvitados)
                ->whereIn('id', $usuariosOrganizadores)
                ->where('id', '<>', $eventoOwnerId)
                ->get();
        }else{
            $users = User::where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
            })
                ->whereNotIn('id', $invitadosIds)
                ->whereNotIn('id', $permisosIds)
                ->whereIn('id', $usuariosInvitados)
                ->where('id', '<>', $eventoOwnerId)
                ->get();
        }
        

            return view('invitar', ['users' => $users, 'eventoId' => $eventoId]);
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

        $yaInvitado = Invitacion::where('user_id', $invitadoId)
                                ->where('event_id', $eventoId)
                                ->exists();

        if ($yaInvitado) {
            return redirect()->route('invitar', ['eventoId' => $eventoId])
                             ->with('error', 'Este usuario ya ha sido invitado.');
        }

        Invitacion::create([
            'user_id' => $invitadoId,
            'event_id' => $eventoId,
            'fecha' => now(),
        ]);
        

        return redirect()->route('invitar', ['eventoId' => $eventoId])
                         ->with('success', 'Invitación enviada correctamente.');
    }

    public function misinvitaciones()
    {
        $userId = Auth::id();

        $invitaciones = Invitacion::where('user_id', $userId)
                                ->where('asistencia', 'pendiente')
                                ->with('evento')
                                ->get();                           
        
        return view('misinvitaciones', ['invitaciones' => $invitaciones]);

    }

    public function aceptar($InvitacionID)
    {
        $userId = Auth::id();
        $invitacion = Invitacion::where('id', $InvitacionID)
                                ->where('user_id', $userId)
                                ->firstorFail();
        
        $invitacion->update(['estado' => 'aceptada']);

        $invitado = User::findOrFail($invitacion->user_id);

        if ($invitado->role === 'organizador') {
            Permiso::Create(
                [
                    'user_id' => $invitacion->user_id,
                    'event_id' => $invitacion->event_id,
                    'asistencia' => 'pendiente',
                    'verEvento' => true,
                    'invitar' => true,
                    'eliminarIvitado' => true,
                    'modificar' => true,
                    'eliminarEvento' => false,
                ]
            );
        } else {
            Permiso::create([
                'user_id' => $invitacion->user_id,
                'event_id' => $invitacion->event_id,
                'asistencia' => 'pendiente',
                'verEvento' => true,
                'invitar' => false,
                'eliminarIvitado' => false,
                'modificar' => false,
                'eliminarEvento' => false,
            ]);
        }
        return redirect()->route('misinvitaciones')->with('success', 'Invitación aceptada correctamente.');
    }

    public function rechazar($InvitacionID)
    {

        $userId = Auth::id();
        $invitacion = Invitacion::where('id', $InvitacionID)
                                ->where('user_id', $userId)
                                ->firstorFail();
        
        $invitacion->update(['estado' => 'rechazada']);

        $invitado = User::findOrFail($invitacion->user_id);

        if ($invitado->role === 'organizador') {
            Permiso::Create(
                [
                    'user_id' => $invitacion->user_id,
                    'event_id' => $invitacion->event_id,
                    'asistencia' => 'pendiente',
                    'verEvento' => false,
                    'invitar' => false,
                    'eliminarIvitado' => false,
                    'modificar' => false,
                    'eliminarEvento' => false,
                ]
            );
        } else {
            Permiso::create([
                'user_id' => $invitacion->user_id,
                'event_id' => $invitacion->event_id,
                'asistencia' => 'pendiente',
                'verEvento' => false,
                'invitar' => false,
                'eliminarIvitado' => false,
                'modificar' => false,
                'eliminarEvento' => false,
            ]);
        }
        return redirect()->route('misinvitaciones')->with('failure', 'Invitación rechazada correctamente.');
    }
}
