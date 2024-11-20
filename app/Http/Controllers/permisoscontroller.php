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
        $eventoId = $request->input('event_id');
        $invitadoId = $request->input('invitado_id');
        $permiso = Permiso::where('user_id', $invitadoId)
                        ->where('event_id', $eventoId)
                        ->first();

        $evento = Evento::findOrFail($eventoId);
        $eventoOwnerId = $evento->user_id;

        
        if (!$permiso->darPermisos|| $userId !== $eventoOwnerId) {
            abort(403, 'No tienes permiso para modificar este permiso.');
        }
        
        $permisos = [
            'verEvento' => $request->has('verEvento') ? true : false,
            'invitar' => $request->has('invitar') ? true : false,
            'eliminarIvitado' => $request->has('eliminarInvitado') ? true : false,
            'modificar' => $request->has('modificar') ? true : false,
            'eliminarEvento' => $request->has('eliminarEvento') ? true : false,
            'darPermisos' => $request->has('darPermisos') ? true : false,
        ];
    
        $permiso->update($permisos);
        
        return redirect()->back()->with('success', 'Permisos actualizados correctamente.');
    }
    

}

