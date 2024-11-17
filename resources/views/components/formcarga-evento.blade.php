<script>
let map;
let marker;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -34.0, lng: -64.0},
        zoom: 4
    });

    map.addListener("click", (e) => {
        placeMarker(e.latLng);
    });
}

function placeMarker(location) {
    if (marker) {
        marker.setPosition(location);
    } else {
        marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }

    document.getElementById("lat").value = location.lat();
    document.getElementById("lng").value = location.lng();
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&callback=initMap&libraries=places"></script>

<button onclick="window.location.href = '/fullcalendar'" class="arrow-button">
    &larr;
</button>

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

    <div class="form-group">
        <label for="color" class="form-label">Color</label>
        <input type="color" id="color" name="color" class="form-input-color">
    </div>

    <div class="form-group form-check">
        <input type="checkbox" id="allDay" name="allDay" class="form-check-input">
        <label for="allDay" class="form-check-label">Todo el día</label>
    </div>

    <div class="form-group">
        <label class="form-label">Ubicación del evento</label>
        <div id="map" class="map-container"></div>
    </div>

    <input type="hidden" id="lat" name="latitude">
    <input type="hidden" id="lng" name="longitude">

    <button type="submit" class="form-button">Guardar Evento</button>
</form>