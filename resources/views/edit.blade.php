@extends('layouts.index')
@section('title','Ingrese los datos del evento')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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


    <div class="form-group">
        <label for="categoria" class="form-label">Categoría</label>
        <select name="categoria_id" id="categoria" class="form-input" required>
            <option value="" disabled selected>Seleccione una categoría</option>
            @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}" 
                {{ old('categoria_id', $evento->categoria_id) == $categoria->id ? 'selected' : '' }}>
                {{ $categoria->nombre }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="fechaInicio" class="form-label">Fecha de Inicio:</label>
            <input type="date" id="fechaInicio" name="fechaInicio" class="form-control form-control-lg" 
                   value="{{ old('fechaInicio', date('Y-m-d', strtotime($evento->fechaInicio))) }}" required>
        </div>
        <div class="col-md-6 mb-4">
            <label for="horaInicio" class="form-label">Hora de Inicio:</label>
            <input type="time" id="horaInicio" name="horaInicio" class="form-control form-control-lg" 
                   value="{{ old('horaInicio', date('H:i', strtotime($evento->fechaInicio))) }}" required>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="fechaFin" class="form-label">Fecha de Fin:</label>
            <input type="date" id="fechaFin" name="fechaFin" class="form-control form-control-lg" 
                   value="{{ old('fechaFin', date('Y-m-d', strtotime($evento->fechaFin))) }}" required>
        </div>
        <div class="col-md-6 mb-4">
            <label for="horaFin" class="form-label">Hora de Fin:</label>
            <input type="time" id="horaFin" name="horaFin" class="form-control form-control-lg" 
                   value="{{ old('horaFin', date('H:i', strtotime($evento->fechaFin))) }}" required>
        </div>
    </div>      

    <div class="form-check mb-4">        
        <input type="checkbox" id="publico" name="publico" class="form-check-input" {{  $evento->publico ? 'checked' : '' }}>
        <label for="publico" class="form-check-label">Publico</label>
    </div>    

    <div class="form-group">
        <label class="form-label">Dirección</label>
        <input class= "form-input" type="text" id="autocomplete" name="direccion"></input>        
    </div>

    <div class="form-group">
        <label class="form-label">Ubicación del evento</label>
        <div id="mapedit" class="map-container"></div>
    </div>

    <input type="hidden" id="latitud" name="latitude">
    <input type="hidden" id="longitud" name="longitude">

    <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg">Actualizar Evento</button>
    </div>
</form>

@endsection

<script>
    let map;
    let marker;
    
    </script>
    <script src="{{ asset('assets/js/mapwithinput.js') }}" defer></script>
