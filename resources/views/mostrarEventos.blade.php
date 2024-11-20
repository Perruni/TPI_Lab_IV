@extends('layouts.index')
@section('title', 'Eventos Disponibles')

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<button onclick="window.location.href = '/fullcalendar'" class="arrow-button">
    &larr;
</button>

<form action="{{ route('mostrarEventos') }}" method="GET">
        <label for="categoria">Filtrar por categoría:</label>
        <select name="categoria" id="categoria" onchange="this.form.submit()">
            <option value="">Todas</option>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id }}" {{ request('categoria') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->nombre }}
                </option>
            @endforeach
        </select>
    </form>
    
<div class="container">
    <h1 class="my-4">Eventos Disponibles</h1>
    <div class="row">
        @foreach($eventos as $evento)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $evento->nombreEvento }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
                    <p><strong>Fecha Inicio:</strong> {{ $evento->fechaInicio }} {{ $evento->horaInicio }}</p>
                    <p><strong>Fecha Fin:</strong> {{ $evento->fechaFin }} {{ $evento->horaFin }}</p>                  
                </div>
                <div class="card-footer">
                    <a href="{{ route('eventodetallado', $evento->id) }}" class="btn btn-primary">Ver Detalles</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
