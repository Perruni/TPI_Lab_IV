<?php

namespace App\Http\Controllers;
use App\Helpers\ApiHelper;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\evento;
use App\Models\Categoria;
use App\Models\Permiso;
use App\Models\Invitacion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Models\Notificacion;

class eventocontroller extends Controller
{
    

    
    public function index(Request $request)
    {
        $userId = Auth::id();

        $puedeVerEventos = Permiso::where('user_id', $userId)
            ->where('verEvento', true)
            ->pluck('event_id');

        $eventos = Evento::where('user_id', $userId)
            ->orWhereIn('id', $puedeVerEventos)
            ->filtrarPorCategoria($request->categoria) 
            ->paginate(10);

        $notificaciones = Notificacion::where('user_id', $userId)
            ->where('leido', false)
            ->get();

        $categorias = Categoria::all();

        return view('miseventos', [
            'eventos' => $eventos,
            'notificaciones' => $notificaciones,
            'categoria' => $categorias,
        ]);
    }

    
    public function mostrarEventosView(Request $request)
    {
        $categorias = Categoria::all(); 
        
        $eventos = Evento::where('publico' , true)
                            ->filtrarPorCategoria($request->categoria)
                            ->with('Categoria')
                            ->paginate(3);
    
        return view('mostrareventos', [
            'eventos' => $eventos,
            'categorias' => $categorias, 
        ]);
    }


    public function cargar(){      

        $user = Auth::user();
        $categorias = Categoria::all();        
    
        if ($user->rol === 'organizador') {
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
            'direccion' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        
        ]);
        
        
        $fechaInicioCompleta = Carbon::parse($request->fechaInicio . ' ' . $request->horaInicio);
        $fechaFinCompleta = Carbon::parse($request->fechaFin . ' ' . $request->horaFin);
        
        if ($fechaFinCompleta->lte($fechaInicioCompleta)) {
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
            'direccion' => $request->direccion,
            'latitude' => $request->latitude, 
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('miseventos')->with('message', 'Evento guardado con éxito.');
    }    
    

    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        $userId = Auth::id(); 

        $categorias = Categoria::all();

        return view('edit', ['evento' => $evento,'userId' => $userId,
            'categorias' => $categorias,
        ]);

    }

    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);
                
        $validated = $request->validate([
            'nombreEvento' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fechaInicio' => 'required|date|after_or_equal:' . Carbon::tomorrow()->toDateString(),
            'horaInicio' => 'required|date_format:H:i',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'horaFin' => 'required|date_format:H:i',
            'categoria_id' => 'required|exists:categorias,id',
            'direccion' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        
        ]);        
        

        $fechaInicioCompleta = Carbon::parse($validated['fechaInicio'] . ' ' . $validated['horaInicio']);
        $fechaFinCompleta = Carbon::parse($validated['fechaFin'] . ' ' . $validated['horaFin']);
        
        if ($fechaFinCompleta->lte($fechaInicioCompleta)) {
            return redirect()->back()->withErrors(['horaFin' => 'La hora de fin debe ser mayor que la hora de inicio si el evento es hoy.']);
        }

        $evento->update([
            'nombreEvento' => $validated['nombreEvento'],
            'descripcion' => $validated['descripcion'],
            'fechaInicio' => $fechaInicioCompleta,
            'fechaFin' => $fechaFinCompleta,
            'publico' => $request->has('publico') ? true : false,
            'direccion' => $validated['direccion'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],

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

        return view('fullcalendar',['eventos'=> $eventos]);

    }
    

    public function mostrarEventos(Request $request)
    {
        $categorias = Categoria::all();

    $eventosQuery = Evento::where('publico', true);

    if ($request->has('categoria_id') && $request->categoria_id != '') {
        $eventosQuery->where('categoria_id', $request->categoria_id);
    }

    $eventos = $eventosQuery->paginate(3);

    return view('mostrareventos', compact('eventos', 'categorias'));
    }

    public function EventoDetallado($id)
    {
        $evento = Evento::findOrFail($id); 
        $permisos = Permiso::where('event_id', $id)
                            ->with('user')
                            ->get();
                            
        return view('eventodetallado', [
            'evento' => $evento,
            'permisos' => $permisos,
        ]);
    }

    public function buscarEventos(Request $request)
{
    $search = $request->input('search');

    $eventos = Evento::where('publico', true) 
        ->when($search, function ($query, $search) {
            $query->where('nombreEvento', 'like', '%' . $search . '%'); 
        })
        ->get();

    return view('buscareventos', compact('eventos'));
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

        $event = Evento::findOrFail($invitacion->event_id);

        if ($userId !== $event->user_id && (!$permiso || !$permiso->eliminarIvitado)) {
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
