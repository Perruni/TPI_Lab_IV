@extends('layouts.index')

@section('title', 'Calendario')

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



<div id='calendar'></div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var events = [
            @foreach ($eventos as $evento)
                {
                    title: '{{ $evento->nombreEvento }}',
                    start: '{{ $evento->fechaInicio }}',
                    @if ($evento->fechaFin)
                        end: '{{ $evento->fechaFin }}',
                    @endif
                    allDay: {{ $evento->allDay ? 'true' : 'false' }},
                    color: '{{ $evento->color }}',
                    className: 'evento-personalizado' 
                } @if (!$loop->last), @endif
            @endforeach
        ];     

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: events,
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día'
            }
        });

        calendar.render();
    });
</script>
@endsection

