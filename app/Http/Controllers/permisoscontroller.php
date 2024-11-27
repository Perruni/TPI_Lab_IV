<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permiso;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class permisoscontroller extends Controller
{
    public function index()
    {
        $permisos = Permiso::all();
    

        return view('evento.detallesevento',['permisos'=> $permisos]);

    }
    
    public function actualizarPermisos(Request $request)
    {
        $userId = Auth::id();
        $invitadoId = $request->input('invitado_id');
        $eventoId = $request->input('event_id');
        $permiso = Permiso::where('user_id', $invitadoId)
                        ->where('event_id', $eventoId)
                        ->first();

        $permisosUsuario = Permiso::where('user_id', $userId)
                        ->where('event_id', $eventoId)
                        ->first();
        
        $evento = Evento::findOrFail($eventoId);
        $eventoOwnerId = $evento->user_id;

        if ($userId !== $eventoOwnerId && !$permisosUsuario->darPermisos) {
            abort(403, 'No tienes permiso para modificar este permiso.');
        }
        
        $permisos = [
            'verEvento' => $request->has('verEvento'),
            'invitar' => $request->has('invitar'),
            'eliminarIvitado' => $request->has('eliminarInvitado'),
            'modificar' => $request->has('modificar'),
            'eliminarEvento' => $request->has('eliminarEvento'),
            'darPermisos' => $request->has('darPermisos'),
        ];
        
        $permiso->update($permisos);
        
        return redirect()->back()->with('success', 'Permisos actualizados correctamente.');
    }
    

}

