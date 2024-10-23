<form action="{{ route('update', $evento->id) }}" method="POST">
    @csrf
    @method('PUT')    

    <div class="form-group">
        <label for="nombreEvento">Nombre del Evento</label>
        <input type="text" name="nombreEvento" id="nombreEvento" class="form-control" value="{{ $evento->nombreEvento }}" required>
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" required>{{ $evento->descripcion }}</textarea>
    </div>

    <div class="form-group">
        <label for="fechaInicio">Fecha de Inicio</label>
        <input type="datetime-local" name="fechaInicio" id="fechaInicio" class="form-control" 
               value="{{ \Carbon\Carbon::parse($evento->fechaInicio)->format('Y-m-d\TH:i') }}" required>
    </div>

    <div class="form-group">
        <label for="fechaFin">Fecha de Fin</label>
        <input type="datetime-local" name="fechaFin" id="fechaFin" class="form-control" 
               value="{{ \Carbon\Carbon::parse($evento->fechaFin)->format('Y-m-d\TH:i') }}" required>
    </div>

    <div class="form-group">
        <label for="color">Color</label>
        <input type="color" name="color" id="color" class="form-control" value="{{ $evento->color }}" required>
    </div>

    <div class="form-group">
        <label for="allDay">Todo el Día</label>
        <input type="checkbox" name="allDay" id="allDay" {{ $evento->allDay ? 'checked' : '' }}>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Evento</button>
    <a href="{{ route('miseventos') }}" class="btn btn-secondary">Cancelar</a>
</form>