@extends('layouts.index')
@section('title', 'Invitar usuarios')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<h3>Llega a la vista invitar</h3>

<form action="{{ route('buscarinvitados') }}" method="GET">
    <div class="mb-3">
        <input class="form-control" type="search" name="search" placeholder="Buscar usuario..." value="{{ request()->search }}">
    </div>
    <input type="hidden" name="eventoId" value="{{ $eventoId }}">    
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>

@if(isset($users) && $users->isNotEmpty())
    <h3>Usuarios encontrados:</h3>
    <ul>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('enviarinvitacion') }}" method="POST">
                                @csrf
                                <input type="hidden" name="eventoId" value="{{ $eventoId }}">
                                <input type="hidden" name="usuario_id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-primary">Invitar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>        
    </ul>
@elseif(isset($users))
    <p>No se encontraron resultados.</p>
@endif




@endsection