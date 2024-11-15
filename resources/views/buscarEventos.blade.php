@extends('layouts.index')

@section('content')

<div class="container">
    <h2 class="mb-4">Resultados de la Búsqueda</h2>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="{{ route('eventos.buscar') }}" class="d-flex mx-auto align-items-center" role="search" style="max-width: 500px; width: 100%;">
        <input class="form-control me-2" type="search" placeholder="Buscar por nombre" name="search" value="{{ request('search') }}" style="flex-grow: 1;">
        <button class="btn btn-outline-success" type="submit" style="width: auto; padding-left: 15px; padding-right: 15px;">Buscar</button>
    </form>

    <!-- Verificar si hay resultados -->
    @if ($eventos->isEmpty())
        <p>No se encontraron eventos que coincidan con tu búsqueda.</p>
    @else
        <div class="list-group mt-4">
            @foreach ($eventos as $evento)
                <a href="{{ route('eventodetallado', ['id' => $evento->id]) }}" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">{{ $evento->nombreEvento }}</h5>
                    <p class="mb-1">{{ Str::limit($evento->descripcion, 100) }}</p>
                    <small>Fecha de Inicio: {{ \Carbon\Carbon::parse($evento->fechaInicio)->format('d/m/Y') }}</small>
                </a>
            @endforeach
        </div>
    @endif
</div>

@endsection
