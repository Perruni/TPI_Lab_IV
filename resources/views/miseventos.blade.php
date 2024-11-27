@extends('layouts.index')
@section('title','Ingrese los datos del evento')
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
@section('content')


@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@elseif(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<x-arrow-button href="/fullcalendar" />

<x-category-filter-form :categoria="$categoria" />

<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('fullcalendar') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mis Eventos
                    
            </ol>
        </nav>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Nombre del Evento</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha de Inicio</th>
            <th scope="col">Fecha de Fin</th>
            <th scope="col">Publico</th>
            <th scope="col">Categoría</th>                                          
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eventos as $evento)
            <tr>
                <td>{{ $evento->nombreEvento }}</td>
                <td>{{ $evento->descripcion }}</td>
                <td>{{ $evento->fechaInicio }}</td>
                <td>{{ $evento->fechaFin }}</td>
                <td>{{ $evento->publico ? 'Sí' : 'No' }}</td>
                <td>{{ $evento->categoria->nombre ?? 'Sin Categoría' }}</td>
                <td>
                    <x-edit-button :route="route('edit', $evento->id)" />

                    <x-detail-button :route="route('eventodetallado', $evento->id)" />

                    <x-delete-button :route="route('borrar', $evento->id)" />
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div>
    {{ $eventos->links() }}
</div>


  
<style>
.evento-actualizacion-formulario {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.evento-campo {
    margin-bottom: 15px;
}

.evento-etiqueta {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

.evento-entrada {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.evento-botones {
    display: flex;
    justify-content: space-between;
}

.evento-boton {
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.evento-boton-actualizar {
    background-color: #28a745;
    color: white;
}

.evento-boton-cancelar {
    background-color: #dc3545;
    color: white;
    text-decoration: none;
}
</style>
@endsection