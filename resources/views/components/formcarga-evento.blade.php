   <!-- <script src="{{ asset('js/map.js') }}" defer></script>>-->
   <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTR_aVqWbhoA0BilVRg_paQy3iUxk8Ouo&callback=initMap&libraries=places"></script>
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

      <div id="map" style="height: 400px; width: 100%;"></div>

        <input type="hidden" id="lat" name="latitude">
        <input type="hidden" id="lng" name="longitude">

    <button type="submit" class="btn btn-primary">Guardar Evento</button>
</form>


<script>
let map;
 let marker;

    function initMap() {
            
        map = new google.maps.Map(document.getElementById('map'), {
         center: { lat: -34.397, lng: 150.644 }, 
            zoom: 8
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