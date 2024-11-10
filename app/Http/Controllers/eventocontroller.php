<?php

namespace App\Http\Controllers;
use App\Helpers\ApiHelper;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\evento;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
 
    //aca empieza 
    public function guardar(Request $request)
    {

        /*if (!isset($request->allDay)) {
            $request->merge(['allDay' => false]); // Es falso si no se envia nada
        }*/

        $request->validate([
            'nombreEvento' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fechaInicio' => 'required|date',
            'horaInicio' => 'required|date_format:H:i',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'horaFin' => 'required|date_format:H:i',
            'color' => 'required|string|size:7',
            'allDay' => 'nullable|boolean', 
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        
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
            'latitude' => $request->latitude, 
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('miseventos')->with('message', 'Evento guardado con éxito.');
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
            'allDay' => 'nullable|boolean', 
         
        ]);

        $fechaInicioCompleta = Carbon::parse($validated['fechaInicio'] . ' ' . $validated['horaInicio']);
        $fechaFinCompleta = Carbon::parse($validated['fechaFin'] . ' ' . $validated['horaFin']);

        $evento->update([
            'nombreEvento' => $validated['nombreEvento'],
            'descripcion' => $validated['descripcion'],
            'fechaInicio' => $fechaInicioCompleta,
            'fechaFin' => $fechaFinCompleta,
            'color' => $validated['color'],
            'allDay' => $validated['allDay'] ? true : false,
            
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
    return view('EventoDetallado', compact('evento'));
}



public function buscarEventos(Request $request)
    {
        $search = $request->input('search');
        $categoriaId = $request->input('categoriaId');

        
        $eventos = Evento::where(function($query) use ($search, $categoriaId) {
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                }
                if ($categoriaId) {
                    $query->where('categoria_id', $categoriaId);
                }
            })
            ->whereNotIn('id', function($subquery) {
                $subquery->select('event_id')
                         ->from('permisos')
                         ->where('user_id', auth()->user()->id);
            })
            ->where('user_id', '<>', auth()->user()->id)
            ->get();

        return view('buscarEventos', compact('eventos'));
    }

}
