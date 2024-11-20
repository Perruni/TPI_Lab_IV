@extends('layouts.index')
@section('title', 'Eventos Disponibles')

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')

<button onclick="window.location.href = '/fullcalendar'" class="arrow-button">
    &larr;
</button>
<div class="container">

<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/fullcalendar') }}">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Eventos Publicos</li>
    </ol>
</nav>

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
