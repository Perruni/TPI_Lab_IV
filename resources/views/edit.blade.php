@extends('layouts.index')
@section('title','Ingrese los datos del evento')

@section('content')

<form action="{{ route('update', $evento->id) }}" method="POST">
    @csrf
    @method('PUT') 
    
    <div class="mb-4">
        <label for="nombreEvento" class="form-label">Nombre del Evento:</label>
        <input type="text" id="nombreEvento" name="nombreEvento" class="form-control form-control-lg" value="{{ old('nombreEvento', $evento->nombreEvento) }}" required>
    </div>

    <div class="mb-4">
        <label for="descripcion" class="form-label">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="4" class="form-control form-control-lg" required>{{ old('descripcion', $evento->descripcion) }}</textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="fechaInicio" class="form-label">Fecha de Inicio:</label>
            <input type="datetime-local" id="fechaInicio" name="fechaInicio" class="form-control form-control-lg" 
                   value="{{ old('fechaInicio', date('Y-m-d\TH:i', strtotime($evento->fechaInicio))) }}" required>
        </div>
        <div class="col-md-6 mb-4">
            <label for="fechaFin" class="form-label">Fecha de Fin:</label>
            <input type="datetime-local" id="fechaFin" name="fechaFin" class="form-control form-control-lg" 
                   value="{{ old('fechaFin', date('Y-m-d\TH:i', strtotime($evento->fechaFin))) }}" required>
        </div>
    </div>    

    <div class="mb-4">
        <label for="color" class="form-label">Color:</label>
        <input type="color" id="color" name="color" class="form-control form-control-lg" value="{{ old('color', $evento->color) }}">
    </div>

    <div class="form-check mb-4">
        <input type="checkbox" id="allDay" name="allDay" class="form-check-input" {{ $evento->allDay ? 'checked' : '' }}>
        <label for="allDay" class="form-check-label">Todo el día</label>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg">Actualizar Evento</button>
    </div>
</form>

@endsection
