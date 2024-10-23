<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\evento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Eventocontroller extends Controller
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

        
        // Combinar la fecha y la hora para crear el formato de fecha completa
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

        return redirect()->back()->with('message', 'Evento guardado con éxito.');
    }

    public function edit($id)
    {
    $evento = Evento::findOrFail($id);

    return view('edit', compact('evento'));
    }

    public function update(Request $request, $id)
    {
        $evento = evento::findOrFail($id);

        $validated = $request->validate([
            'nombreEvento' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fechaInicio' => 'required|date',
            'horaInicio' => 'required|date_format:H:i',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'horaFin' => 'required|date_format:H:i',
            'color' => 'required|string|size:7',
            'allDay' => 'nullable|boolean', 
        ]);

        $evento->update($validated);

        return redirect()->route('index')->with('success', 'Evento actualizado correctamente.');
    }
    

    public function borrar($id)
    {

        $evento = Evento::findOrFail($id);

        $evento->delete();

        return redirect()->route('index')->with('success', 'Evento eliminado correctamente.');
    }

    
}
