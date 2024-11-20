@extends('layouts.index')

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
@if ($invitaciones->isEmpty())

<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('fullcalendar') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Invitaciones
            </ol>
        </nav>
</div>

<div class="alert alert-dark d-flex align-items-center" role="alert">


    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <div>
      No hay invitaciones pendientes.
    </div>
  </div>
    
@endif

@foreach ( $invitaciones as $invitacion)
<div class="card" style="width: 18rem;">
    <h1 class="card-title mb-4">{{ $invitacion->evento->nombreEvento }}</h1>
                    
        <div class="row mb-3">
            <div class="col-12">
                <p><strong>Descripción:</strong> {{ $invitacion->evento->descripcion }}</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <p><strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($invitacion->evento->fechaInicio) }} </p>
            </div>
            <div class="col-md-6 mb-3">
                <p><strong>Fecha de Fin:</strong> {{ \Carbon\Carbon::parse($invitacion->evento->fechaFin) }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <x-aceptar-invitacion :invitacionId="$invitacion->id" />
            </div>
            <div class="col-6">
                <x-rechazar-invitacion :invitacionId="$invitacion->id" />
            </div>
        </div>
  </div>
@endforeach

@endsection 