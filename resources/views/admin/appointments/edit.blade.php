@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center pt-2">Modifica Appuntamento</h1>
        <hr>

        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Cliente --}}
            <div class="mb-3">
                <label for="customer_id" class="form-label">Cliente</label>
                <select class="form-select" id="customer_id" name="customer_id">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}"
                            {{ $appointment->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Parrucchiere --}}
            <div class="mb-3">
                <label for="hairdresser_id" class="form-label">Parrucchiere</label>
                <select class="form-select" id="hairdresser_id" name="hairdresser_id">
                    @foreach ($hairdressers as $hairdresser)
                        <option value="{{ $hairdresser->id }}"
                            {{ $appointment->hairdresser_id == $hairdresser->id ? 'selected' : '' }}>
                            {{ $hairdresser->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Slot --}}
            <div class="mb-3">
                <label for="appointment_slot" class="form-label">Slot</label>
                <input type="text" class="form-control" id="appointment_slot" name="appointment_slot"
                    value="{{ $appointment->appointment_slot }}">
            </div>

            {{-- Descrizione --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" id="description" name="description">{{ $appointment->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Aggiorna</button>
        </form>
    </div>
@endsection
