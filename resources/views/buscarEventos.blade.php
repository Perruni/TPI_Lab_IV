@extends('layouts.index')

@section('content')


</style>

<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('fullcalendar') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Buscar Eventos
            </ol>
        </nav>
</div>

<div class="container">
    <h2 class="mb-4">Resultados de la Búsqueda</h2>


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
