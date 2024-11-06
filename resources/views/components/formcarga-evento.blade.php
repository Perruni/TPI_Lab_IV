

<script>
let autocomplete;
    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('autocomplete'),
            {types: ['establishment'], 
            componentRestrictions: {country: 'AR'},
            fields: ['place_id','geometry','name'] }

        );
    }
</script>

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

<button onclick="window.location.href = '/tu-ruta-deseada'" class="btn btn-primary">
    &larr; Volver
</button>

<form action="{{ route('guardar') }}" method="POST" class="p-3 shadow-sm bg-white rounded" style="max-width: 500px; margin: auto;">
    @csrf
    <h4 class="mb-3 text-primary">Crear Nuevo Evento</h4>

    <div class="form-group mb-2">
        <label for="nombreEvento" class="form-label fw-bold">Nombre del Evento</label>
        <input type="text" id="nombreEvento" name="nombreEvento" class="form-control input-gray text-black" placeholder="Ingrese el nombre del evento" required>
    </div>

    <div class="form-group mb-2">
        <label for="descripcion" class="form-label fw-bold">Descripción</label>
        <textarea id="descripcion" name="descripcion" class="form-control input-gray text-black" rows="2" placeholder="Descripción del evento" required></textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-2">
            <label for="fechaInicio" class="form-label fw-bold">Fecha de Inicio</label>
            <input type="date" id="fechaInicio" name="fechaInicio" class="form-control input-gray text-black" required>
        </div>
        <div class="col-md-6 mb-2">
            <label for="horaInicio" class="form-label fw-bold">Hora de Inicio</label>
            <input type="time" id="horaInicio" name="horaInicio" class="form-control input-gray text-black" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-2">
            <label for="fechaFin" class="form-label fw-bold">Fecha de Fin</label>
            <input type="date" id="fechaFin" name="fechaFin" class="form-control input-gray text-black" required>
        </div>
        <div class="col-md-6 mb-2">
            <label for="horaFin" class="form-label fw-bold">Hora de Fin</label>
            <input type="time" id="horaFin" name="horaFin" class="form-control input-gray text-black" required>
        </div>
    </div>

    <div class="form-group mb-2">
        <label for="color" class="form-label fw-bold">Color</label>
        <input type="color" id="color" name="color" class="form-control form-control-color input-gray text-black">
    </div>

    <div class="form-group form-check mb-2">
        <input type="checkbox" id="allDay" name="allDay" class="form-check-input">
        <label for="allDay" class="form-check-label text-black">Todo el día</label>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Ubicación del evento</label>
        <div id="map" style="height: 300px; width: 100%; border-radius: 5px;"></div>
    </div>

    <input type="hidden" id="lat" name="latitude">
    <input type="hidden" id="lng" name="longitude">

    <button type="submit" class="btn btn-primary w-100">Guardar Evento</button>
</form>
<style>
  .form-label{
    color: #000;
   }
    .input-gray {
        background-color: #f0f0f0 !important; 
        border: 1px solid #ced4da;
        color: #000; 
    }

 
    .text-black {
        color: #000 !important;
    }

    
    ::placeholder {
        color: gray !important;
        opacity: 1;
    }

    
    input[type="date"], input[type="time"] {
        color: gray !important;
    }</style>