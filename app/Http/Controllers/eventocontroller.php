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
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Debes estar autenticado para crear un evento.');
        }

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
}
