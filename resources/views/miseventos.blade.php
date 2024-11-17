@extends('layouts.index')
@section('title','Ingrese los datos del evento')

@section('content')

  <button onclick="window.location.href = '/fullcalendar'" class="arrow-button">
    &larr;
</button>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre del Evento</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha de Inicio</th>
            <th scope="col">Fecha de Fin</th>
            <th scope="col">Color</th>
            <th scope="col">Todo el Día</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eventos as $evento)
            <tr>
                <th scope="row">{{ $evento->id }}</th>
                <td>{{ $evento->nombreEvento }}</td>
                <td>{{ $evento->descripcion }}</td>
                <td>{{ $evento->fechaInicio }}</td>
                <td>{{ $evento->fechaFin }}</td>
                <td>{{ $evento->color }}</td>
                <td>{{ $evento->allDay ? 'Sí' : 'No' }}</td>
                <td>
                    <a href="{{ route('edit', $evento->id) }}" class="btn btn-warning">Editar</a>

                    <form action="{{ route('borrar', $evento->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

  

@endsection