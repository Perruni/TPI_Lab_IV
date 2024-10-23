<form action="{{ route('guardar') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nombreEvento">Nombre del Evento</label>
        <input type="text" id="nombreEvento" name="nombreEvento" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required></textarea>
    </div>

    <div class="form-group">
        <label for="fechaInicio">Fecha de Inicio</label>
        <input type="date" id="fechaInicio" name="fechaInicio" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="horaInicio">Hora de Inicio</label>
        <input type="time" id="horaInicio" name="horaInicio" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="fechaFin">Fecha de Fin</label>
        <input type="date" id="fechaFin" name="fechaFin" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="horaFin">Hora de Fin</label>
        <input type="time" id="horaFin" name="horaFin" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="color">Color</label>
        <input type="color" id="color" name="color" class="form-control">
    </div>

    <div class="form-group">
        <label for="allDay">Todo el día</label>
        <input type="checkbox" id="allDay" name="allDay" class="form-check-input">
    </div>

    <button type="submit" class="btn btn-primary">Guardar Evento</button>
</form>