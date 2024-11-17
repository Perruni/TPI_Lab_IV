@extends('layouts.index')

@section('content')
<button onclick="window.location.href = '/fullcalendar'" class="arrow-button">
    &larr;
</button>
<div class="container-fluid py-5" min-height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card Principal con sombra y borde redondeado -->
            <div class="card shadow-lg rounded-4">
                <div class="card-body">
                    <!-- Título con borde inferior -->
                    <h1 class="card-title mb-4 text-center text-primary">{{ $evento->nombreEvento }}</h1>
                    
                    <div class="row mb-3">
                        <div class="col-12">
                            <p class="lead"><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
                        </div>
                    </div>

                    <!-- Detalles del Evento con iconos -->
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <p><i class="bi bi-calendar-event"></i> <strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($evento->fechaInicio)->format('d/m/Y') }} a las {{ \Carbon\Carbon::parse($evento->horaInicio)->format('H:i') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><i class="bi bi-calendar-x"></i> <strong>Fecha de Fin:</strong> {{ \Carbon\Carbon::parse($evento->fechaFin)->format('d/m/Y') }} a las {{ \Carbon\Carbon::parse($evento->horaFin)->format('H:i') }}</p>
                        </div>
                    </div>

                    <!-- Indicador de si es todo el día -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <p><i class="bi bi-clock"></i> <strong>Todo el Día:</strong> {{ $evento->allDay ? 'Sí' : 'No' }}</p>
                        </div>
                    </div> 

                    <!-- Calendario de Evento (usando tabla) -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h3>Invitados</h3>
                            <a href="{{ route('invitar', ['eventoId' => $evento->id]) }}" class="btn btn-success mb-4"><i class="bi bi-person-plus"></i> Invitar a este evento</a>

                            <!-- Si no hay invitados -->
                            @if ($permisos->isEmpty())
                                <p class="text-muted">Aún no hay invitados.</p>
                            @else
                                <!-- Tabla de Invitados con formato más limpio -->
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="thead-light">
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
                                                    <td>
                                                        @if($permiso->asistencia == 'asistirá')
                                                            <span class="badge bg-success">{{ ucfirst($permiso->asistencia) }}</span>
                                                        @elseif($permiso->asistencia == 'no asistirá')
                                                            <span class="badge bg-danger">{{ ucfirst($permiso->asistencia) }}</span>
                                                        @else
                                                            <span class="badge bg-warning">{{ ucfirst($permiso->asistencia) }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Botón de regreso -->
                    <a href="{{ route('miseventos') }}" class="btn btn-primary"><i class="bi bi-arrow-left-circle"></i> Volver a Eventos</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection