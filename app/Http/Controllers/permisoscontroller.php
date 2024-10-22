<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permiso;
use Illuminate\Http\Request;

class permisoscontroller extends Controller
{
    public function index()
    {
        $permisos = Permiso::all();

        return view('evento.detallesevento',['permisos'=> $permisos]);

    }
    
}

