@extends('layouts.app')

@section('content')

    <head>
        <link
            href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Jost:wght@300;400;500&display=swap"
            rel="stylesheet">
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
                justify-content: space-between;
                margin-bottom: 2.5rem;
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
                font-size: 0.75rem;
                font-weight: 300;
                color: rgba(200, 180, 140, 0.5);
                letter-spacing: 0.15em;
                text-transform: uppercase;
                margin-bottom: 0.4rem;
            }

            .header-actions {
                display: flex;
                gap: 0.75rem;
                align-items: center;
            }

            .btn-gold {
                background: transparent;
                border: 1px solid rgba(200, 180, 140, 0.5);
                color: #c8b48c;
                font-family: 'Jost', sans-serif;
                font-size: 0.72rem;
                font-weight: 400;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                padding: 0.6rem 1.4rem;
                border-radius: 2px;
                text-decoration: none;
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .btn-gold:hover {
                background: rgba(200, 180, 140, 0.1);
                border-color: #c8b48c;
                color: #c8b48c;
            }

            .btn-back {
                background: transparent;
                border: 1px solid rgba(232, 224, 213, 0.15);
                color: rgba(232, 224, 213, 0.5);
                font-family: 'Jost', sans-serif;
                font-size: 0.72rem;
                font-weight: 400;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                padding: 0.6rem 1.4rem;
                border-radius: 2px;
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .btn-back:hover {
                border-color: rgba(232, 224, 213, 0.3);
                color: rgba(232, 224, 213, 0.8);
            }

            /* Columns */
            .hairdressers-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
            }

            .hairdresser-column {
                background: #181818;
                border: 1px solid rgba(200, 180, 140, 0.12);
                border-radius: 4px;
                overflow: hidden;
            }

            .column-header {
                padding: 1.2rem 1.8rem;
                border-bottom: 1px solid rgba(200, 180, 140, 0.12);
                display: flex;
                align-items: center;
                gap: 0.8rem;
            }

            .column-header.elia {
                background: rgba(74, 158, 107, 0.08);
            }

            .column-header.francesca {
                background: rgba(192, 82, 74, 0.08);
            }

            .hairdresser-dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                flex-shrink: 0;
            }

            .hairdresser-dot.elia {
                background: #4a9e6b;
            }

            .hairdresser-dot.francesca {
                background: #c0524a;
            }

            .hairdresser-name {
                font-family: 'Cormorant Garamond', serif;
                font-size: 1.4rem;
                font-weight: 400;
                color: #e8e0d5;
                letter-spacing: 0.05em;
            }

            .appointment-count {
                margin-left: auto;
                font-size: 0.68rem;
                font-weight: 400;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: rgba(200, 180, 140, 0.4);
            }

            .appointments-list {
                padding: 1rem;
            }

            /* Appointment Card */
            .appointment-card {
                background: #111;
                border: 1px solid rgba(200, 180, 140, 0.08);
                border-radius: 3px;
                padding: 1.3rem 1.5rem;
                margin-bottom: 0.75rem;
                transition: border-color 0.2s ease;
                position: relative;
            }

            .appointment-card:hover {
                border-color: rgba(200, 180, 140, 0.2);
            }

            .appointment-card:last-child {
                margin-bottom: 0;
            }

            .appointment-slot-badge {
                display: inline-block;
                font-size: 0.7rem;
                font-weight: 500;
                letter-spacing: 0.12em;
                color: #c8b48c;
                background: rgba(200, 180, 140, 0.08);
                border: 1px solid rgba(200, 180, 140, 0.2);
                border-radius: 2px;
                padding: 0.2rem 0.6rem;
                margin-bottom: 1rem;
            }

            .customer-name {
                font-family: 'Cormorant Garamond', serif;
                font-size: 1.3rem;
                font-weight: 400;
                color: #e8e0d5;
                margin-bottom: 0.8rem;
                letter-spacing: 0.03em;
            }

            .customer-details {
                display: flex;
                flex-direction: column;
                gap: 0.35rem;
                margin-bottom: 1rem;
            }

            .detail-row {
                display: flex;
                align-items: center;
                gap: 0.6rem;
            }

            .detail-label {
                font-size: 0.65rem;
                font-weight: 500;
                letter-spacing: 0.15em;
                text-transform: uppercase;
                color: rgba(200, 180, 140, 0.4);
                min-width: 60px;
            }

            .detail-value {
                font-size: 0.85rem;
                font-weight: 300;
                color: rgba(232, 224, 213, 0.75);
            }

            .detail-value a {
                color: rgba(200, 180, 140, 0.7);
                text-decoration: none;
            }

            .detail-value a:hover {
                color: #c8b48c;
            }

            .description-box {
                background: rgba(200, 180, 140, 0.04);
                border-left: 2px solid rgba(200, 180, 140, 0.2);
                padding: 0.6rem 0.9rem;
                margin-bottom: 1rem;
                font-size: 0.82rem;
                font-weight: 300;
                color: rgba(232, 224, 213, 0.55);
                font-style: italic;
                border-radius: 0 2px 2px 0;
            }

            .card-actions {
                display: flex;
                gap: 0.5rem;
                padding-top: 0.8rem;
                border-top: 1px solid rgba(200, 180, 140, 0.08);
            }

            .btn-edit {
                background: transparent;
                border: 1px solid rgba(200, 180, 140, 0.25);
                color: rgba(200, 180, 140, 0.7);
                font-family: 'Jost', sans-serif;
                font-size: 0.68rem;
                font-weight: 400;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                padding: 0.4rem 0.9rem;
                border-radius: 2px;
                text-decoration: none;
                transition: all 0.2s ease;
            }

            .btn-edit:hover {
                background: rgba(200, 180, 140, 0.08);
                border-color: #c8b48c;
                color: #c8b48c;
            }

            .btn-delete {
                background: transparent;
                border: 1px solid rgba(192, 82, 74, 0.25);
                color: rgba(192, 82, 74, 0.6);
                font-family: 'Jost', sans-serif;
                font-size: 0.68rem;
                font-weight: 400;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                padding: 0.4rem 0.9rem;
                border-radius: 2px;
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .btn-delete:hover {
                background: rgba(192, 82, 74, 0.08);
                border-color: #c0524a;
                color: #c0524a;
            }

            /* Empty state */
            .empty-state {
                padding: 3rem 1.5rem;
                text-align: center;
                color: rgba(200, 180, 140, 0.25);
                font-size: 0.8rem;
                font-weight: 300;
                letter-spacing: 0.1em;
                text-transform: uppercase;
            }

            .empty-state-icon {
                font-size: 2rem;
                margin-bottom: 0.8rem;
                opacity: 0.3;
            }

            @media (max-width: 768px) {
                .hairdressers-grid {
                    grid-template-columns: 1fr;
                }

                .page-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 1rem;
                }
            }
        </style>
    </head>

    <body>
        <div class="admin-wrapper">
            @include('admin.partials.sidebar')

            <div class="main-content">
                <div class="page-header">
                    <div>
                        <div class="page-subtitle">Appuntamenti del giorno</div>
                        <h1 class="page-title">{{ \Carbon\Carbon::parse($date)->locale('it')->isoFormat('D MMMM YYYY') }}
                        </h1>
                    </div>
                    <div class="header-actions">
                        <a href="{{ route('appointments.create', ['date' => $date]) }}" class="btn-gold">
                            + Nuovo Appuntamento
                        </a>
                        <button onclick="history.back()" class="btn-back">
                            ← Torna al Calendario
                        </button>
                    </div>
                </div>

                <div class="hairdressers-grid">

                    <!-- Colonna Elia -->
                    <div class="hairdresser-column">
                        <div class="column-header elia">
                            <div class="hairdresser-dot elia"></div>
                            <div class="hairdresser-name">Elia</div>
                            <div class="appointment-count">
                                {{ $appointments->where('hairdresser.name', 'Elia')->count() }} appuntamenti
                            </div>
                        </div>
                        <div class="appointments-list">
                            @php $eliaAppointments = $appointments->filter(fn($a) => $a->hairdresser->name == 'Elia'); @endphp
                            @forelse ($eliaAppointments as $appointment)
                                <div class="appointment-card">
                                    <div class="appointment-slot-badge">{{ $appointment->appointment_slot }}</div>
                                    <div class="customer-name">{{ $appointment->customer->name }}</div>
                                    <div class="customer-details">
                                        <div class="detail-row">
                                            <span class="detail-label">Email</span>
                                            <span class="detail-value">
                                                <a
                                                    href="mailto:{{ $appointment->customer->email }}">{{ $appointment->customer->email }}</a>
                                            </span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Tel</span>
                                            <span class="detail-value">
                                                <a
                                                    href="tel:{{ $appointment->customer->phone }}">{{ $appointment->customer->phone }}</a>
                                            </span>
                                        </div>
                                    </div>
                                    @if ($appointment->description)
                                        <div class="description-box">{{ $appointment->description }}</div>
                                    @endif
                                    <div class="card-actions">
                                        <a href="{{ route('appointments.edit', $appointment->id) }}"
                                            class="btn-edit">Modifica</a>
                                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST"
                                            style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete"
                                                onclick="return confirm('Cancellare questo appuntamento?')">Cancella</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state">
                                    <div class="empty-state-icon">○</div>
                                    Nessun appuntamento
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Colonna Francesca -->
                    <div class="hairdresser-column">
                        <div class="column-header francesca">
                            <div class="hairdresser-dot francesca"></div>
                            <div class="hairdresser-name">Francesca</div>
                            <div class="appointment-count">
                                {{ $appointments->where('hairdresser.name', 'Francesca')->count() }} appuntamenti
                            </div>
                        </div>
                        <div class="appointments-list">
                            @php $francescaAppointments = $appointments->filter(fn($a) => $a->hairdresser->name == 'Francesca'); @endphp
                            @forelse ($francescaAppointments as $appointment)
                                <div class="appointment-card">
                                    <div class="appointment-slot-badge">{{ $appointment->appointment_slot }}</div>
                                    <div class="customer-name">{{ $appointment->customer->name }}</div>
                                    <div class="customer-details">
                                        <div class="detail-row">
                                            <span class="detail-label">Email</span>
                                            <span class="detail-value">
                                                <a
                                                    href="mailto:{{ $appointment->customer->email }}">{{ $appointment->customer->email }}</a>
                                            </span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Tel</span>
                                            <span class="detail-value">
                                                <a
                                                    href="tel:{{ $appointment->customer->phone }}">{{ $appointment->customer->phone }}</a>
                                            </span>
                                        </div>
                                    </div>
                                    @if ($appointment->description)
                                        <div class="description-box">{{ $appointment->description }}</div>
                                    @endif
                                    <div class="card-actions">
                                        <a href="{{ route('appointments.edit', $appointment->id) }}"
                                            class="btn-edit">Modifica</a>
                                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST"
                                            style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete"
                                                onclick="return confirm('Cancellare questo appuntamento?')">Cancella</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state">
                                    <div class="empty-state-icon">○</div>
                                    Nessun appuntamento
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>
@endsection
