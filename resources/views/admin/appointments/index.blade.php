@extends('layouts.app')

@section('content')

    <head>
        <meta charset='utf-8' />
        <link
            href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Jost:wght@300;400;500&display=swap"
            rel="stylesheet">
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
        <style>
            body {
                background-color: #1a1a1a;
                color: #e8e0d5;
                font-family: 'Jost', sans-serif;
            }

            .admin-wrapper {
                display: flex;
                width: 100%;
                min-height: calc(100vh - 56px);
                background: #1a1a1a;
            }

            .main-content {
                flex: 1;
                min-width: 0;
                padding: 2.5rem;
                background: #1a1a1a;
            }

            .page-header {
                display: flex;
                align-items: flex-end;
                gap: 1rem;
                margin-bottom: 2rem;
                padding-bottom: 1.5rem;
                border-bottom: 1px solid rgba(200, 180, 140, 0.2);
            }

            .page-title {
                font-family: 'Cormorant Garamond', serif;
                font-size: 2.8rem;
                font-weight: 300;
                color: #c8b48c;
                letter-spacing: 0.04em;
                line-height: 1;
                margin: 0;
            }

            .page-subtitle {
                font-size: 0.8rem;
                font-weight: 300;
                color: rgba(200, 180, 140, 0.5);
                letter-spacing: 0.15em;
                text-transform: uppercase;
                margin-bottom: 0.3rem;
            }

            .calendar-card {
                background: #181818;
                border: 1px solid rgba(200, 180, 140, 0.15);
                border-radius: 4px;
                padding: 2rem;
                box-shadow: 0 8px 40px rgba(0, 0, 0, 0.4);
            }

            /* FullCalendar overrides */
            .fc {
                font-family: 'Jost', sans-serif !important;
            }

            .fc .fc-toolbar-title {
                font-family: 'Cormorant Garamond', serif !important;
                font-size: 1.6rem !important;
                font-weight: 400 !important;
                color: #c8b48c !important;
                letter-spacing: 0.05em;
            }

            .fc .fc-button {
                background: transparent !important;
                border: 1px solid rgba(200, 180, 140, 0.3) !important;
                color: #c8b48c !important;
                border-radius: 2px !important;
                font-family: 'Jost', sans-serif !important;
                font-size: 0.75rem !important;
                font-weight: 400 !important;
                letter-spacing: 0.1em !important;
                text-transform: uppercase !important;
                padding: 0.4rem 1rem !important;
                transition: all 0.2s ease !important;
                box-shadow: none !important;
            }

            .fc .fc-button:hover {
                background: rgba(200, 180, 140, 0.1) !important;
                border-color: #c8b48c !important;
            }

            .fc .fc-button-primary:not(:disabled).fc-button-active {
                background: rgba(200, 180, 140, 0.15) !important;
                border-color: #c8b48c !important;
            }

            .fc .fc-col-header-cell-cushion {
                font-family: 'Jost', sans-serif !important;
                font-size: 0.72rem !important;
                font-weight: 500 !important;
                letter-spacing: 0.15em !important;
                text-transform: uppercase !important;
                color: rgba(200, 180, 140, 0.5) !important;
                text-decoration: none !important;
                padding: 0.8rem 0 !important;
            }

            .fc .fc-daygrid-day-number {
                font-size: 0.85rem !important;
                color: rgba(232, 224, 213, 0.6) !important;
                text-decoration: none !important;
                padding: 0.5rem !important;
            }

            .fc .fc-daygrid-day.fc-day-today {
                background: rgba(200, 180, 140, 0.06) !important;
            }

            .fc .fc-daygrid-day.fc-day-today .fc-daygrid-day-number {
                color: #c8b48c !important;
                font-weight: 500 !important;
            }

            .fc .fc-daygrid-day:hover {
                background: rgba(200, 180, 140, 0.04) !important;
                cursor: pointer;
            }

            .fc-theme-standard td,
            .fc-theme-standard th {
                border-color: rgba(200, 180, 140, 0.1) !important;
            }

            .fc-theme-standard .fc-scrollgrid {
                border-color: rgba(200, 180, 140, 0.1) !important;
            }

            .fc .fc-daygrid-event {
                border-radius: 2px !important;
                font-size: 0.72rem !important;
                font-family: 'Jost', sans-serif !important;
                font-weight: 400 !important;
                padding: 2px 6px !important;
                border: none !important;
                margin: 1px 2px !important;
            }

            .fc .fc-event-title {
                font-weight: 400 !important;
            }

            .fc .fc-daygrid-day-bg .fc-highlight {
                background: rgba(200, 180, 140, 0.08) !important;
            }

            /* Legend */
            .legend {
                display: flex;
                gap: 1.5rem;
                margin-bottom: 1.5rem;
                align-items: center;
            }

            .legend-item {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-size: 0.75rem;
                font-weight: 300;
                letter-spacing: 0.08em;
                color: rgba(232, 224, 213, 0.6);
                text-transform: uppercase;
            }

            .legend-dot {
                width: 10px;
                height: 10px;
                border-radius: 50%;
            }

            .legend-dot.elia {
                background: #4a9e6b;
            }

            .legend-dot.francesca {
                background: #c0524a;
            }

            .stats-row {
                display: flex;
                gap: 1rem;
                margin-bottom: 2rem;
            }

            .stat-card {
                flex: 1;
                background: #111;
                border: 1px solid rgba(200, 180, 140, 0.12);
                border-radius: 3px;
                padding: 1.2rem 1.5rem;
                display: flex;
                flex-direction: column;
                gap: 0.3rem;
            }

            .stat-label {
                font-size: 0.68rem;
                font-weight: 400;
                letter-spacing: 0.15em;
                text-transform: uppercase;
                color: rgba(200, 180, 140, 0.45);
            }

            .stat-value {
                font-family: 'Cormorant Garamond', serif;
                font-size: 2rem;
                font-weight: 400;
                color: #c8b48c;
                line-height: 1;
            }

            /* Tip click */
            .click-tip {
                text-align: center;
                margin-top: 1.5rem;
                font-size: 0.72rem;
                font-weight: 300;
                letter-spacing: 0.12em;
                color: rgba(200, 180, 140, 0.3);
                text-transform: uppercase;
            }
        </style>
    </head>

    <body>
        <div class="admin-wrapper">
            @include('admin.partials.sidebar')

            <div class="main-content">
                <div class="page-header">
                    <div>
                        <div class="page-subtitle">Backoffice — Officina 05</div>
                        <h1 class="page-title">Calendario</h1>
                    </div>
                </div>

                <!-- Stats -->
                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-label">Appuntamenti totali</div>
                        <div class="stat-value">{{ count($events) }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Clicca un giorno per vedere i dettagli</div>
                        <div class="stat-value"
                            style="font-size:1rem; color: rgba(200,180,140,0.4); font-family:'Jost',sans-serif; font-weight:300; padding-top:0.4rem;">
                            Tutti gli appuntamenti sono visibili sul calendario
                        </div>
                    </div>
                </div>

                <div class="calendar-card">
                    <!-- Legend -->
                    <div class="legend">
                        <div class="legend-item">
                            <div class="legend-dot elia"></div>
                            Elia
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot francesca"></div>
                            Francesca
                        </div>
                    </div>

                    <div id='calendar'></div>

                    <div class="click-tip">↑ clicca su un giorno per vedere gli appuntamenti</div>
                </div>
            </div>
        </div>

        <script>
            var events = @json($events);
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    height: 580,
                    locale: 'it',
                    firstDay: 1,
                    events: events,
                    eventColor: '#4a9e6b',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek'
                    },
                    buttonText: {
                        today: 'Oggi',
                        month: 'Mese',
                        week: 'Settimana'
                    },
                    dateClick: function(info) {
                        window.location.href = '/admin/appointments/show/' + info.dateStr;
                    }
                });
                calendar.render();
            });
        </script>
    </body>
@endsection
