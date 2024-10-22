<div>
    <form action="{{ $action }}" method="{{ strtoupper($method) }}">
        @csrf
       
        <div>
            <label for="nombreEvento">Nombre del Evento:</label>
            <input type="text" id="nombreEvento" name="nombreEvento" required>
        </div>

        <div>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>

        <div>
            <label for="fechaInicio">Fecha de Inicio:</label>
            <input type="datetime-local" id="fechaInicio" name="fechaInicio" required>
        </div>

        <div>
            <label for="fechaFin">Fecha de Fin:</label>
            <input type="datetime-local" id="fechaFin" name="fechaFin" required>
        </div>

        <div>
            <label for="color">Color:</label>
            <input type="text" id="color" name="color">
        </div>

        <div>
            <label for="allDay">Todo el día:</label>
            <input type="checkbox" id="allDay" name="allDay">
        </div>

        <button type="submit">Guardar Evento</button>
    </form>

</div>