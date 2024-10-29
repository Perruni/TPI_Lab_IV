@extends('layouts.index')
@section('title', 'Eventos Disponibles')

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')
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
