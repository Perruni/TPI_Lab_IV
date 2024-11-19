@extends('layouts.index')
@section('title','Ingrese los datos del evento')

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

<x-formcarga-evento :categorias="$categorias" />
  

@endsection