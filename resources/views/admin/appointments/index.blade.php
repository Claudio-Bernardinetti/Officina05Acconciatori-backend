@extends('layouts.app')


@section('content')

    <head>
        <meta charset='utf-8' />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
        <script>
            var events = @json($events);
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    height: 600,
                    events: events,
                    dateClick: function(info) {
                        // Reindirizza all'URL desiderato con la data come parametro
                        window.location.href = '/admin/appointments/show/' + info
                            .dateStr; // Modifica il percorso secondo le tue esigenze
                    }
                });
                calendar.render();
            });
        </script>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">

                <!-- Sidebar -->
                @include('admin.partials.sidebar')

                <!-- Main Content -->
                <div id='calendar' class="col-md-10 pt-3 my-custom-calendar"></div>
            </div>
        </div>

    </body>
    {{-- <style>
        .my-custom-calendar {
            height: 500px;
            /* Sostituisci con l'altezza desiderata */
        }
    </style> --}}
@endsection
