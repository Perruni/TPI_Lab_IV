<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\evento;
use App\Models\Permiso;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class eventocontroller extends Controller
{
    

    public function index()
    {
        $userId = Auth::id();

        $eventos = Evento::where('user_id', $userId)->get();   

        return view('miseventos',['eventos'=> $eventos]);

    }


    public function cargar(){      

        return view('cargar');

    }

    public function guardar(Request $request)
    {

        $request->validate([
            'nombreEvento' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fechaInicio' => 'required|date',
            'horaInicio' => 'required|date_format:H:i',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'horaFin' => 'required|date_format:H:i',
            'color' => 'required|string|size:7',
            'allDay' => 'nullable|boolean', 
        ]);

        
        $fechaInicioCompleta = Carbon::parse($request->fechaInicio . ' ' . $request->horaInicio);
        $fechaFinCompleta = Carbon::parse($request->fechaFin . ' ' . $request->horaFin);
        $userId = Auth::id();        

        Evento::create([
            'user_id' => $userId,
            'nombreEvento' => $request->nombreEvento,
            'descripcion' => $request->descripcion,
            'fechaInicio' => $fechaInicioCompleta,
            'fechaFin' => $fechaFinCompleta,
            'color' => $request->color,
            'allDay' => $request->allDay ? true : false,
        ]);

        return redirect()->route('miseventos')->with('message', 'Evento guardado con éxito.');
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

        $eventos = Evento::where('user_id', $userId)->get();   

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

    
}
