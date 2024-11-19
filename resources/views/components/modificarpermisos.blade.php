<div>
    <form action="{{ route('actualizar-permisos') }}" method="POST">
        @csrf
        <input type="hidden" name="invitado_id" value="{{ $invitadoId }}">
        <input type="hidden" name="event_id" value="{{ $eventId }}">
    
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="invitado">Selecciona un Invitado</label>
                <select class="form-control" id="invitado" name="invitado_id">
                    <option value="{{ $invitadoId }}" selected>Invitado Actual</option>
                </select>
            </div>
    
            <div class="col-md-6 mb-3">
                <label for="permisos">Modificar Permisos</label>
                <div>
                    <input type="checkbox" id="verEvento" name="permisos[]" value="verEvento">
                    <label for="verEvento">Ver Evento</label>
                </div>
                <div>
                    <input type="checkbox" id="invitar" name="permisos[]" value="invitar">
                    <label for="invitar">Invitar</label>
                </div>
                <div>
                    <input type="checkbox" id="eliminarInvitado" name="permisos[]" value="eliminarIvitado">
                    <label for="eliminarInvitado">Eliminar Invitado</label>
                </div>
                <div>
                    <input type="checkbox" id="modificar" name="permisos[]" value="modificar">
                    <label for="modificar">Modificar Evento</label>
                </div>
                <div>
                    <input type="checkbox" id="eliminarEvento" name="permisos[]" value="eliminarEvento">
                    <label for="eliminarEvento">Eliminar Evento</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Permisos</button>
    </form>
</div>