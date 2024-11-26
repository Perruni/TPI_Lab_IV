@extends('layouts.index')

@section('content')

<x-arrow-button href="/fullcalendar" />

<div class="container-fluid py-5" min-height: 100vh;">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('fullcalendar') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('miseventos') }}">Mis Eventos</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $evento->nombreEvento }}</li>
            </ol>
        </nav>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-4">
                <div class="card-body">
                    <h1 class="card-title mb-4 text-center text-primary">{{ $evento->nombreEvento }}</h1>
                    
                    <div class="row mb-3">
                        <div class="col-12">
                            <p class="lead"><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <p><i class="bi bi-calendar-event"></i> <strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($evento->fechaInicio)->format('d/m/Y') }} a las {{ \Carbon\Carbon::parse($evento->horaInicio)->format('H:i') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><i class="bi bi-calendar-x"></i> <strong>Fecha de Fin:</strong> {{ \Carbon\Carbon::parse($evento->fechaFin)->format('d/m/Y') }} a las {{ \Carbon\Carbon::parse($evento->horaFin)->format('H:i') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <p><i class="bi bi-clock"></i> <strong>Todo el Día:</strong> {{ $evento->allDay ? 'Sí' : 'No' }}</p>
                        </div>
                    </div>                 

                    <div class="form-group">
                        <label id="direccion" class="form-label">Dirección: {{ $evento->direccion }}</label>
                        <label id ="ubicacion" class="form-label">Ubicación del evento</label>
                        <div id="mapedit" class="map-container"></div>
                    </div>

                    <input type="hidden" id="latitud" name="latitude" value={{ $evento->latitude }}>
                    <input type="hidden" id="longitud" name="longitude" value={{ $evento->longitude }}>

                    

                    @if(auth()->user()->id === $evento->user_id)
                    <div class="row mb-4">
                        <div class="col-12">
                            <h3>Invitados</h3>
                            <a href="{{ route('invitar', ['eventoId' => $evento->id]) }}" class="btn btn-success mb-4"><i class="bi bi-person-plus"></i> Invitar a este evento</a>

                            @if ($permisos->isEmpty())
                                <p class="text-muted">Aún no hay invitados.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Email</th>
                                                <th>Estado de Invitación</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permisos as $permiso)
                                                <tr>
                                                    <td>{{ $permiso->user->name }}</td>
                                                    <td>{{ $permiso->user->email }}</td>
                                                    <td>
                                                        @if($permiso->asistencia == 'aceptada')
                                                            <span class="badge bg-success">{{ ucfirst($permiso->asistencia) }}</span>
                                                        @elseif($permiso->asistencia == 'rechazada')
                                                            <span class="badge bg-danger">{{ ucfirst($permiso->asistencia) }}</span>
                                                        @else
                                                            <span class="badge bg-warning">{{ ucfirst($permiso->asistencia) }}</span>
                                                        @endif
                                                    </td>                                                    
                                                    <td>
                                                        <x-eliminarinvitado :eliminarInvitado="true" :permiso="$permiso" />
                                                        <x-modificarpermisos :invitadoId="$permiso->user_id" :eventId="$evento->id" :permiso="$permiso" />
                                                    </td>
                                                </tr>
                                                
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    <a href="{{ route('miseventos') }}" class="btn btn-primary"><i class="bi bi-arrow-left-circle"></i> Volver a Eventos</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
function initMap() {
    const prevLat = document.getElementById('latitud').value;
    const prevLng = document.getElementById('longitud').value;
    const defaultLocation = {
            lat: parseFloat(prevLat),
            lng: parseFloat(prevLng),
        };
    map = new google.maps.Map(document.getElementById("mapedit"), {
        center: defaultLocation,
        zoom: 16
    });
    placeMarker(defaultLocation);
}

function placeMarker(location) {
            marker = new google.maps.Marker({
            position: location,
            map: map
        });  

} 
</script>

@endsection
