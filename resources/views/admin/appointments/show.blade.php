@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center pt-2">Appuntamenti per {{ $date }}</h1>
        <hr>
        <div class="row">
            <!-- Colonna di sinistra per Elia -->
            <div class="col-md-6">
                <h3>Appuntamenti di Elia</h3>
                @foreach ($appointments as $appointment)
                    @if ($appointment->hairdresser->name == 'Elia')
                        <div>
                            <p><strong>Cliente:</strong> {{ $appointment->customer->name }}</p>
                            <p><strong>Email:</strong> {{ $appointment->customer->email }}</p>
                            <p><strong>Telefono:</strong> {{ $appointment->customer->phone }}</p>
                            <p><strong>Slot:</strong> {{ $appointment->appointment_slot }}</p>
                            @if ($appointment->description)
                                <p><strong>Descrizione:</strong> {{ $appointment->description }}</p>
                            @endif
                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Cancella</button>
                            </form>
                            <hr>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Colonna di destra per Francesca -->
            <div class="col-md-6">
                <h3>Appuntamenti di Francesca</h3>
                @foreach ($appointments as $appointment)
                    @if ($appointment->hairdresser->name == 'Francesca')
                        <div>
                            <p><strong>Cliente:</strong> {{ $appointment->customer->name }}</p>
                            <p><strong>Email:</strong> {{ $appointment->customer->email }}</p>
                            <p><strong>Telefono:</strong> {{ $appointment->customer->phone }}</p>
                            <p><strong>Slot:</strong> {{ $appointment->appointment_slot }}</p>
                            @if ($appointment->description)
                                <p><strong>Descrizione:</strong> {{ $appointment->description }}</p>
                            @endif
                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Cancella</button>
                            </form>
                            <hr>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Bottone per tornare indietro -->
        <button onclick="history.back()" class="btn btn-secondary">Torna Indietro</button>
    </div>
@endsection
