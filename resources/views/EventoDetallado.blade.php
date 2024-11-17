@extends('layouts.index')
@section('title', 'Detalles del Evento')

@section('content')
<button onclick="window.location.href = '/fullcalendar'" class="arrow-button">
    &larr;
</button>
<div class="container-fluid py-5" min-height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow p-4 border-0">
                <div class="card-body">
                    <h1 class="card-title mb-4">{{ $evento->nombreEvento }}</h1>
                    
                    <div class="row mb-3">
                        <div class="col-12">
                            <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($evento->fechaInicio)->format('d/m/Y') }} a las {{ \Carbon\Carbon::parse($evento->horaInicio)->format('H:i') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Fecha de Fin:</strong> {{ \Carbon\Carbon::parse($evento->fechaFin)->format('d/m/Y') }} a las {{ \Carbon\Carbon::parse($evento->horaFin)->format('H:i') }}</p>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-12">
                            <p><strong>Todo el Día:</strong> {{ $evento->allDay ? 'Sí' : 'No' }}</p>
                        </div>
                    </div>                 
                    
                    <div class="row mb-4">
                        <div class="col-12">
                            <h3>Invitados</h3>
                            <a href="{{ route('invitar', ['eventoId' => $evento->id]) }}" class="btn btn-success mb-4">Invitar a este evento</a>
                            @if ($permisos->isEmpty())
                            <p>Aún no hay invitados.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Estado de Invitación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permisos as $permiso)
                                        <tr>
                                            <td>{{ $permiso->user->name }}</td>
                                            <td>{{ $permiso->user->email }}</td>
                                            <td>{{ ucfirst($permiso->asistencia) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        </div>
                    </div>
                    
                    <a href="{{ route('miseventos') }}" class="btn btn-primary">Volver a Eventos</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
