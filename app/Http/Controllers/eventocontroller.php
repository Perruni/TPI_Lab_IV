<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\evento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class eventocontroller extends Controller
{
    

    public function index()
    {
        $eventos = Evento::all();

        return view('evento.miseventos',['eventos'=> $eventos]);

    }


    public function cargar(){
        
        return view('evento.cargar');

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

        Evento::create([
            'user_id' => 1,
            'nombreEvento' => $request->nombreEvento,
            'descripcion' => $request->descripcion,
            'fechaInicio' => $fechaInicioCompleta,
            'fehcaFin' => $fechaFinCompleta,
            'color' => $request->color,
            'allDay' => $request->allDay ? true : false,
        ]);

        return redirect()->back()->with('message', 'Evento guardado con éxito.');
    }
}
