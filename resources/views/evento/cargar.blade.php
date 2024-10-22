@extends('layouts.index')
@section('title','Ingrese los datos del evento')

@section('content')

  
    <x-formcarga-evento>
        <input type="text" id="nombreEvento" name="nombreEvento" class="form-control" required>
        <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required></textarea>
        <input type="date" id="fechaInicio" name="fechaInicio" class="form-control" required>
        <input type="time" id="horaInicio" name="horaInicio" class="form-control" required>
        <input type="date" id="fechaFin" name="fechaFin" class="form-control" required>
        <input type="time" id="horaFin" name="horaFin" class="form-control" required>
        <input type="color" id="color" name="color" class="form-control">
        <input type="checkbox" id="allDay" name="allDay" class="form-check-input">
  </x-formcarga-evento>
  

@endsection