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

            .page-subtitle {
                font-size: 0.75rem;
                font-weight: 300;
                color: rgba(200, 180, 140, 0.5);
                letter-spacing: 0.15em;
                text-transform: uppercase;
                margin-bottom: 0.4rem;
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
                text-decoration: none;
            }

            .btn-back:hover {
                border-color: rgba(232, 224, 213, 0.3);
                color: rgba(232, 224, 213, 0.8);
            }

            /* Form sections */
            .form-card {
                background: #181818;
                border: 1px solid rgba(200, 180, 140, 0.12);
                border-radius: 4px;
                overflow: hidden;
                margin-bottom: 1.2rem;
            }

            .form-card-header {
                padding: 1rem 1.8rem;
                border-bottom: 1px solid rgba(200, 180, 140, 0.1);
                display: flex;
                align-items: center;
                gap: 0.7rem;
            }

            .form-card-header-dot {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: #c8b48c;
                opacity: 0.6;
            }

            .form-card-title {
                font-size: 0.7rem;
                font-weight: 500;
                letter-spacing: 0.18em;
                text-transform: uppercase;
                color: rgba(200, 180, 140, 0.6);
            }

            .form-card-body {
                padding: 1.5rem 1.8rem;
            }

            .form-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1.2rem;
            }

            .form-group {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                margin-bottom: 1.2rem;
            }

            .form-group:last-child {
                margin-bottom: 0;
            }

            .form-label {
                font-size: 0.68rem;
                font-weight: 500;
                letter-spacing: 0.15em;
                text-transform: uppercase;
                color: rgba(200, 180, 140, 0.5);
            }

            .form-control,
            .form-select {
                background: #111 !important;
                border: 1px solid rgba(200, 180, 140, 0.15) !important;
                border-radius: 2px !important;
                color: #e8e0d5 !important;
                font-family: 'Jost', sans-serif !important;
                font-size: 0.88rem !important;
                font-weight: 300 !important;
                padding: 0.7rem 1rem !important;
                transition: border-color 0.2s ease !important;
                outline: none !important;
                box-shadow: none !important;
            }

            .form-control:focus,
            .form-select:focus {
                border-color: rgba(200, 180, 140, 0.45) !important;
                background: #131313 !important;
                box-shadow: none !important;
                color: #e8e0d5 !important;
            }

            .form-control::placeholder {
                color: rgba(232, 224, 213, 0.2) !important;
            }

            .form-select option {
                background: #181818;
                color: #e8e0d5;
            }

            textarea.form-control {
                resize: vertical;
                min-height: 90px;
            }

            /* Divider between new/existing customer */
            .or-divider {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin: 1.5rem 0;
                color: rgba(200, 180, 140, 0.25);
            }

            .or-divider::before,
            .or-divider::after {
                content: '';
                flex: 1;
                height: 1px;
                background: rgba(200, 180, 140, 0.12);
            }

            .or-divider span {
                font-size: 0.65rem;
                font-weight: 500;
                letter-spacing: 0.2em;
                text-transform: uppercase;
            }

            /* Hairdresser selector */
            .hairdresser-selector {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 0.75rem;
            }

            .hairdresser-option {
                position: relative;
            }

            .hairdresser-option input[type="radio"] {
                position: absolute;
                opacity: 0;
                width: 0;
                height: 0;
            }

            .hairdresser-label {
                display: flex;
                align-items: center;
                gap: 0.7rem;
                padding: 1rem 1.2rem;
                background: #111;
                border: 1px solid rgba(200, 180, 140, 0.12);
                border-radius: 3px;
                cursor: pointer;
                transition: all 0.2s ease;
                font-size: 0.9rem;
                font-weight: 300;
                color: rgba(232, 224, 213, 0.6);
            }

            .hairdresser-label:hover {
                border-color: rgba(200, 180, 140, 0.3);
                color: #e8e0d5;
            }

            .hairdresser-option input:checked+.hairdresser-label {
                border-color: rgba(200, 180, 140, 0.5);
                background: rgba(200, 180, 140, 0.06);
                color: #c8b48c;
            }

            .hairdresser-dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                flex-shrink: 0;
            }

            .dot-elia {
                background: #4a9e6b;
            }

            .dot-francesca {
                background: #c0524a;
            }

            /* Form actions */
            .form-actions {
                display: flex;
                gap: 0.75rem;
                margin-top: 2rem;
            }

            .btn-submit {
                background: rgba(200, 180, 140, 0.1);
                border: 1px solid rgba(200, 180, 140, 0.4);
                color: #c8b48c;
                font-family: 'Jost', sans-serif;
                font-size: 0.75rem;
                font-weight: 400;
                letter-spacing: 0.15em;
                text-transform: uppercase;
                padding: 0.8rem 2rem;
                border-radius: 2px;
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .btn-submit:hover {
                background: rgba(200, 180, 140, 0.18);
                border-color: #c8b48c;
            }

            /* Error messages */
            .alert-danger {
                background: rgba(192, 82, 74, 0.08);
                border: 1px solid rgba(192, 82, 74, 0.25);
                border-radius: 3px;
                color: rgba(232, 180, 170, 0.9);
                font-size: 0.82rem;
                padding: 1rem 1.3rem;
                margin-bottom: 1.5rem;
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
                        <h1 class="page-title">Nuovo Appuntamento</h1>
                    </div>
                    <button onclick="history.back()" class="btn-back">← Torna Indietro</button>
                </div>

                @if ($errors->any())
                    <div class="alert-danger">
                        <ul style="margin:0; padding-left:1.2rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf

                    <!-- Data e Slot -->
                    <div class="form-card">
                        <div class="form-card-header">
                            <div class="form-card-header-dot"></div>
                            <div class="form-card-title">Data e Orario</div>
                        </div>
                        <div class="form-card-body">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="appointment_date" class="form-label">Data</label>
                                    <input type="date" class="form-control" id="appointment_date" name="appointment_date"
                                        value="{{ $date }}">
                                </div>
                                <div class="form-group">
                                    <label for="appointment_slot" class="form-label">Slot orario</label>
                                    <select class="form-select" id="appointment_slot" name="appointment_slot">
                                        @forelse ($availableSlots as $slot)
                                            <option value="{{ $slot }}">{{ $slot }}</option>
                                        @empty
                                            <option value="">Nessuno slot disponibile</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Parrucchiere -->
                    <div class="form-card">
                        <div class="form-card-header">
                            <div class="form-card-header-dot"></div>
                            <div class="form-card-title">Acconciatore</div>
                        </div>
                        <div class="form-card-body">
                            <div class="hairdresser-selector">
                                @foreach ($hairdressers as $hairdresser)
                                    <div class="hairdresser-option">
                                        <input type="radio" id="hairdresser_{{ $hairdresser->id }}" name="hairdresser_id"
                                            value="{{ $hairdresser->id }}" {{ $loop->first ? 'checked' : '' }}>
                                        <label for="hairdresser_{{ $hairdresser->id }}" class="hairdresser-label">
                                            <div
                                                class="hairdresser-dot {{ $hairdresser->name == 'Elia' ? 'dot-elia' : 'dot-francesca' }}">
                                            </div>
                                            {{ $hairdresser->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Nuovo Cliente -->
                    <div class="form-card">
                        <div class="form-card-header">
                            <div class="form-card-header-dot"></div>
                            <div class="form-card-title">Nuovo Cliente</div>
                        </div>
                        <div class="form-card-body">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="new_customer_name" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="new_customer_name"
                                        name="new_customer_name" placeholder="Nome e cognome">
                                </div>
                                <div class="form-group">
                                    <label for="new_customer_phone" class="form-label">Telefono</label>
                                    <input type="text" class="form-control" id="new_customer_phone"
                                        name="new_customer_phone" placeholder="+39">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new_customer_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="new_customer_email" name="new_customer_email"
                                    placeholder="email@esempio.com">
                            </div>

                            <div class="or-divider"><span>oppure cliente esistente</span></div>

                            <div class="form-group" style="margin-bottom:0">
                                <label for="customer_id" class="form-label">Seleziona Cliente</label>
                                <select class="form-select" id="customer_id" name="customer_id">
                                    <option value="">— Seleziona —</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }} —
                                            {{ $customer->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Descrizione -->
                    <div class="form-card">
                        <div class="form-card-header">
                            <div class="form-card-header-dot"></div>
                            <div class="form-card-title">Note</div>
                        </div>
                        <div class="form-card-body">
                            <div class="form-group" style="margin-bottom:0">
                                <label for="description" class="form-label">Descrizione servizio</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Taglio, colore, trattamento..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">Crea Appuntamento</button>
                        <button type="button" class="btn-back" onclick="history.back()">Annulla</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
@endsection
