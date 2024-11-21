<form action="{{ route('update', $evento->id) }}" method="POST" class="evento-actualizacion-formulario">
    @csrf
    @method('PUT')

    <div class="evento-campo evento-campo-nombre">
        <label for="nombreEvento" class="evento-etiqueta evento-etiqueta-nombre">Nombre del Evento</label>
        <input type="text" name="nombreEvento" id="nombreEvento" 
               class="evento-entrada evento-entrada-nombre" 
               value="{{ $evento->nombreEvento }}" required>
    </div>

    <div class="evento-campo evento-campo-descripcion">
        <label for="descripcion" class="evento-etiqueta evento-etiqueta-descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" 
                  class="evento-entrada evento-entrada-descripcion" required>{{ $evento->descripcion }}</textarea>
    </div>

    <div class="evento-campo evento-campo-fecha-inicio">
        <label for="fechaInicio" class="evento-etiqueta evento-etiqueta-fecha-inicio">Fecha de Inicio</label>
        <input type="datetime-local" name="fechaInicio" id="fechaInicio" 
               class="evento-entrada evento-entrada-fecha-inicio" 
               value="{{ \Carbon\Carbon::parse($evento->fechaInicio)->format('Y-m-d\TH:i') }}" required>
    </div>

    <div class="evento-campo evento-campo-fecha-fin">
        <label for="fechaFin" class="evento-etiqueta evento-etiqueta-fecha-fin">Fecha de Fin</label>
        <input type="datetime-local" name="fechaFin" id="fechaFin" 
               class="evento-entrada evento-entrada-fecha-fin" 
               value="{{ \Carbon\Carbon::parse($evento->fechaFin)->format('Y-m-d\TH:i') }}" required>
    </div>

    <div class="evento-campo evento-campo-color">
        <label for="color" class="evento-etiqueta evento-etiqueta-color">Color</label>
        <input type="color" name="color" id="color" 
               class="evento-entrada evento-entrada-color" 
               value="{{ $evento->color }}" required>
    </div>

    <div class="evento-campo evento-campo-todo-dia">
        <label for="allDay" class="evento-etiqueta evento-etiqueta-todo-dia">Todo el Día</label>
        <input type="checkbox" name="allDay" id="allDay" 
               class="evento-entrada evento-entrada-checkbox" 
               {{ $evento->allDay ? 'checked' : '' }}>
    </div>

    <div class="evento-botones">
        <button type="submit" class="evento-boton evento-boton-actualizar">Actualizar Evento</button>
        <a href="{{ route('miseventos') }}" class="evento-boton evento-boton-cancelar">Cancelar</a>
    </div>
</form>