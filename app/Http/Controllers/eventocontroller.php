<?php

namespace App\Http\Controllers;
use App\Helpers\ApiHelper;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\evento;
use App\Models\Categoria;
use App\Models\Permiso;
use App\Models\Invitacion;
use App\Models\User_roles;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Models\Notificacion;

class eventocontroller extends Controller
{
    

    
    public function index()
    {
        $userId = Auth::id();

        $puedeVerEventos = Permiso::where('user_id', $userId)
                                ->where('verEvento', true)
                                ->pluck('event_id');

        $eventos = Evento::where('user_id', $userId) 
                    ->orWhereIn('id', $puedeVerEventos)
                    ->with('categoria')
                    ->get();
        
        $notificaciones = Notificacion::where('user_id', $userId)
                                  ->where('leido', false)
                                  ->get();

        return view('miseventos',['eventos'=> $eventos, 'notificaciones' => $notificaciones]);

    }


    public function cargar(){      

        $userId = Auth::id();
        $categorias = Categoria::all();

        $userRol = User_roles::where('user_id', $userId)->get();
        if ($userRol->first()->organizador) {
            return view('cargar',['categorias' => $categorias]);
        }
        else {
            return redirect()->route('miseventos')->with('message', 'No tienes permisos para crear eventos');
        }
        

    }
 
    //aca empieza 
    public function guardar(Request $request)
    {

        $request->validate([
            'nombreEvento' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fechaInicio' => 'required|date|after_or_equal:' . Carbon::tomorrow()->toDateString(),
            'horaInicio' => 'required|date_format:H:i',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'horaFin' => 'required|date_format:H:i',
            'categoria_id' => 'required|exists:categorias,id', 
            'publico' => 'nullable|boolean', 
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        
        ]);

        
        $fechaInicioCompleta = Carbon::parse($request->fechaInicio . ' ' . $request->horaInicio);
        $fechaFinCompleta = Carbon::parse($request->fechaFin . ' ' . $request->horaFin);
        
        if ($fechaInicioCompleta->isToday() && $fechaFinCompleta->lte($fechaInicioCompleta)) {
            return redirect()->back()->withErrors(['horaFin' => 'La hora de fin debe ser mayor que la hora de inicio si el evento es hoy.']);
        }
        
        $userId = Auth::id();        

        Evento::create([
            'user_id' => $userId,
            'nombreEvento' => $request->nombreEvento,
            'descripcion' => $request->descripcion,
            'fechaInicio' => $fechaInicioCompleta,
            'fechaFin' => $fechaFinCompleta,
            'categoria_id' => $request->categoria_id,
            'publico' => $request->publico ? true : false,
            'latitude' => $request->latitude, 
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('miseventos')->with('message', 'Evento guardado con éxito.');
    }
    //aca termina

    /*Esto es para mostrar el mapa*/
    public function showMap()
    {
        $apiKey = config('services.google_maps.api_key');
         return view('formcarga-evento',compact('apiKey'));
    }

    

    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        $userId = Auth::id(); 

        return view('edit', compact('evento', 'userId'));
    }

    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);
                
        $validated = $request->validate([
            'nombreEvento' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fechaInicio' => 'required|date',
            'horaInicio' => 'required|date_format:H:i',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'horaFin' => 'required|date_format:H:i',
            'color' => 'required|string|size:7',            
        ]);                
        

        $fechaInicioCompleta = Carbon::parse($validated['fechaInicio'] . ' ' . $validated['horaInicio']);
        $fechaFinCompleta = Carbon::parse($validated['fechaFin'] . ' ' . $validated['horaFin']);
        
        $evento->update([
            'nombreEvento' => $validated['nombreEvento'],
            'descripcion' => $validated['descripcion'],
            'fechaInicio' => $fechaInicioCompleta,
            'fechaFin' => $fechaFinCompleta,
            'color' => $validated['color'],
            'allDay' => $request['allDay'] ? true : false,

        ]);
        
        return redirect()->route('miseventos')->with('success', 'Evento actualizado correctamente.');
    }
    

    public function borrar($id)
    {

        $evento = Evento::findOrFail($id);

        $evento->delete();

        return redirect()->route('miseventos')->with('success', 'Evento eliminado correctamente.');
    }

    public function fullCalendar()
    {
        $userId = Auth::id();

        $puedeVerEventos = Permiso::where('user_id', $userId)
                                ->where('verEvento', true)
                                ->pluck('event_id');

        $eventos = Evento::where('user_id', $userId) 
                    ->orWhereIn('id', $puedeVerEventos)
                    ->get();          

        return view('fullCalendar',['eventos'=> $eventos]);

    }
    
    public function mostrarEventos()
    {
        $eventos = Evento::all(); //Aca iria la logica para ver solo los publicos
        return view('mostrarEventos', compact('eventos'));
    }

    public function EventoDetallado($id)
    {
        $evento = Evento::findOrFail($id); 
        $permisos = Permiso::where('event_id', $id)
                            ->with('user')
                            ->get();

        return view('eventoDetallado', [
            'evento' => $evento,
            'permisos' => $permisos,
        ]);
    }


    public function buscarEventos(Request $request)
        {
            $search = $request->input('search');
            $userId = Auth::id();
    
            //$categoriaId = $request->input('categoriaId');
            
            $eventos = Evento::where(function($query) use ($search) {
                    if ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    }
                    //if ($categoriaId) {
                    //    $query->where('categoria_id', $categoriaId);
                    //}
                })
                ->whereNotIn(function($subquery) use($userId) {
                    $subquery->select('event_id')
                            ->from('permisos')
                            ->where('user_id', $userId);
                })
                ->where('user_id', '<>', $userId)
                ->get();

            return view('buscarEventos', compact('eventos'));
        }

    public function eliminarInvitado($invitadoId)
    {

        $userId = Auth::id();

        $invitacion = Invitacion::findOrFail($invitadoId);

        if ($invitacion->asistencia === 'rechazada') {
            return redirect()->back()->with('error', 'Este invitado ya ha rechazado la invitación o ya ha sido eliminado del evento.');
        }

        $permiso = Permiso::where('user_id', $invitacion->user_id)
                        ->where('event_id', $invitacion->event_id)
                        ->first();

        if (!$permiso || !$permiso->eliminarIvitado || $userId === $permiso->user_id) {
            abort(403, 'No tienes permiso para modificar esta invitación.');
        }

        Invitacion::updateOrCreate(
            [
                'id' => $invitacion->id,
            ],
            [
                'user_id' => $invitacion->user_id,
                'event_id' => $invitacion->event_id,
                'asistencia' => 'rechazada',
                'fecha' => $invitacion->fecha ?? now(),
            ]
        );

        Permiso::updateOrCreate(
                [
                    'user_id' => $invitacion->user_id,
                    'event_id' => $invitacion->event_id,
                ],
                [
                    'asistencia' => 'rechazada',
                    'verEvento' => false,
                    'invitar' => false,
                    'eliminarIvitado' => false,
                    'modificar' => false,
                    'eliminarEvento' => false,
                    'darPermisos' => false,
                ]
            );
        return redirect()->back()->with('success', 'Invitado eliminado correctamente.');
    }
}
