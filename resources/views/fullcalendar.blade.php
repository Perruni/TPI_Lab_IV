@extends('layouts.index')

@section('title', 'Calendario')

@section('content')
<div id='calendar'></div>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.min.css' rel='stylesheet' />

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
                    color: '{{ $evento->color }}'
                } @if (!$loop->last), @endif
            @endforeach
        ];     
       

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: events,
            locale: 'es'
        });

        calendar.render();
    });
</script>

<style>
    
  #calendar {
    background-color: white; 
    color: black;
  }

  .fc .fc-daygrid-day, 
  .fc .fc-daygrid-day-number,
  .fc .fc-event {
    background-color: white;
    color: black;
  }
  
  .fc .fc-toolbar { 
    background-color: white;
    color: black;
  }
  
  .fc .fc-button {
    background-color: white;
    color: black;
    border: 1px solid black;
  }

  .fc .fc-button:hover {
    background-color: black;
    color: white;
  }

</style>

@endsection
