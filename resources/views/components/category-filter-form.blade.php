<div class="formulario-filtradoDiv">
<form action="{{ route('miseventos') }}" method="GET" class="formulario-filtrado1">
    <label for="categoria">Filtrar por categoría:</label>
    <select name="categoria" id="categoria" onchange="this.form.submit()">
        <option value="">Todas</option>
        @foreach($categoria as $cat)
            <option value="{{ $cat->id }}" {{ request('categoria') == $cat->id ? 'selected' : '' }}>
                {{ $cat->nombre }}
            </option>
        @endforeach
    </select>
</form>
</div>