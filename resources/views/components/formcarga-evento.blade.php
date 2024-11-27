<x-arrow-button href="/fullcalendar" />

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@elseif(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('guardar') }}" method="POST" class="form-container">
    @csrf
    <h4 class="form-title">Crear Nuevo Evento</h4>

    <div class="form-group">
        <label for="nombreEvento" class="form-label">Nombre del Evento</label>
        <input type="text" id="nombreEvento" name="nombreEvento" class="form-input" placeholder="Ingrese el nombre del evento" required>
    </div>

    <div class="form-group">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea id="descripcion" name="descripcion" class="form-input" rows="2" placeholder="Descripción del evento" required></textarea>
    </div>


    <div class="form-group">
        <label for="categoria" class="form-label">Categoría</label>
        <select name="categoria_id" id="categoria" class="form-input" required>
            <option value="" disabled selected>Seleccione una categoría</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
            <input type="date" id="fechaInicio" name="fechaInicio" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="horaInicio" class="form-label">Hora de Inicio</label>
            <input type="time" id="horaInicio" name="horaInicio" class="form-input" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="fechaFin" class="form-label">Fecha de Fin</label>
            <input type="date" id="fechaFin" name="fechaFin" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="horaFin" class="form-label">Hora de Fin</label>
            <input type="time" id="horaFin" name="horaFin" class="form-input" required>
        </div>
    </div>    

    <div class="form-group form-check">
        <input type="checkbox" id="publico" name="publico" class="form-check-input">
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

    <button type="submit" class="form-button">Guardar Evento</button>
</form>

     
<script src="{{ asset('assets/js/mapwithinput.js') }}"></script>