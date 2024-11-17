@extends('layouts.index')

@section('content')

@if ($invitaciones->isEmpty())
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
                <p><strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($invitacion->evento->fechaInicio)->format('d/m/Y') }} a las {{ \Carbon\Carbon::parse($invitacion->evento->horaInicio)->format('H:i') }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <p><strong>Fecha de Fin:</strong> {{ \Carbon\Carbon::parse($invitacion->evento->fechaFin)->format('d/m/Y') }} a las {{ \Carbon\Carbon::parse($invitacion->evento->horaFin)->format('H:i') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <form action="{{ route('aceptar', ['InvitacionID' => $invitacion->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                      </svg></button>
                </form>
            </div>
            <div class="col-6">
                <form action="{{ route('rechazar', ['InvitacionID' => $invitacion->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                      </svg></button>
                </form>
            </div>
        </div>
  </div>
@endforeach

@endsection 