<div class="form-container">
    <h2 class="form-title">Actualizar Evento</h2>
    <form action="{{ route('update', $evento->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombreEvento" class="form-label">Nombre del Evento</label>
            <input type="text" name="nombreEvento" id="nombreEvento" class="form-input" value="{{ $evento->nombreEvento }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-input" required>{{ $evento->descripcion }}</textarea>
        </div>

        <div class="form-group">
            <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
            <input type="datetime-local" name="fechaInicio" id="fechaInicio" class="form-input"
                   value="{{ \Carbon\Carbon::parse($evento->fechaInicio)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="form-group">
            <label for="fechaFin" class="form-label">Fecha de Fin</label>
            <input type="datetime-local" name="fechaFin" id="fechaFin" class="form-input"
                   value="{{ \Carbon\Carbon::parse($evento->fechaFin)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="form-group">
            <label for="color" class="form-label">Color</label>
            <input type="color" name="color" id="color" class="form-input-color" value="{{ $evento->color }}" required>
        </div>

        <div class="form-group form-row">
            <label for="allDay" class="form-check-label">
                <input type="checkbox" name="allDay" id="allDay" class="form-check-input" {{ $evento->allDay ? 'checked' : '' }}>
                Todo el Día
            </label>
        </div>

        <button type="submit" class="form-button">Actualizar Evento</button>
    </form>
</div>