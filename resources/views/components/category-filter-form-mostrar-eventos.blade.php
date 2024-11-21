<div class="formulario-filtradoDiv">
<form action="{{ route('mostrarEventos') }}" method="GET" class="formulario-filtrado">
    <label for="categoria">Filtrar por categoría:</label>
    <select name="categoria" id="categoria" onchange="this.form.submit()">
        <option value="">Todas</option>
        @foreach($categorias as $cat)
            <option value="{{ $cat->id }}" {{ request('categoria') == $cat->id ? 'selected' : '' }}>
                {{ $cat->nombre }}
            </option>
        @endforeach
    </select>
</form>
</div>
