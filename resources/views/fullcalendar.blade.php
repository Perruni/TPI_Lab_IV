@extends('layouts.index')
@section('title')

@section('content')
<!DOCTYPE html>
<html lang='es'>
<head>
  <meta charset='utf-8' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

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
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es'
      });
      calendar.render();
    });
  </script>
</head>
<body>
  <div id='calendar'></div>
</body>
</html>
@endsection