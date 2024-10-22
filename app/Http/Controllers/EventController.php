<?php

// app/Http/Controllers/EventController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; 

class EventController extends Controller
{
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            
            'nombreEvento' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
            'color' => 'nullable|string|max:7',
            'allDay' => 'nullable|boolean',
        ]);

      
        Event::create($validatedData);

        
        return redirect()->back()->with('success', 'Evento creado exitosamente');
    }
}
