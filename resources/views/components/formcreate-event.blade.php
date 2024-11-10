
<div class="container mt-4">
    <form action="{{ $action }}" method="{{ strtoupper($method) }}" class="custom-form p-5 rounded shadow-lg">
        @csrf
       
        <div class="mb-4">
            <label for="nombreEvento" class="form-label">Nombre del Evento:</label>
            <input type="text" id="nombreEvento" name="nombreEvento" class="form-control form-control-lg" required>
        </div>

        <div class="mb-4">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" class="form-control form-control-lg" required></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <label for="fechaInicio" class="form-label">Fecha de Inicio:</label>
                <input type="datetime-local" id="fechaInicio" name="fechaInicio" class="form-control form-control-lg" required>
            </div>
            <div class="col-md-6 mb-4">
                <label for="fechaFin" class="form-label">Fecha de Fin:</label>
                <input type="datetime-local" id="fechaFin" name="fechaFin" class="form-control form-control-lg" required>
            </div>
        </div>

        <div class="mb-4">
            <label for="color" class="form-label">Color:</label>
            <input type="text" id="color" name="color" class="form-control form-control-lg">
        </div>

        <div class="form-check mb-4">
            <input type="checkbox" id="allDay" name="allDay" class="form-check-input">
            <label for="allDay" class="form-check-label">Todo el día</label>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg">Guardar Evento</button>
        </div>
    </form>
</div>
