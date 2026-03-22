@extends('layouts.app')
@section('content')
    <div
        style="
    position: relative;
    width: 100%;
    height: calc(100vh - 56px);
    overflow: hidden;
    background: #111;
">
        <img src="{{ asset('assets/img/o05a-back-office.jpg') }}" alt="Officina 05"
            style="
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            object-fit: cover;
            object-position: center;
            opacity: 0.85;
        ">
        <!-- Overlay scuro in basso -->
        <div
            style="
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 50%;
        background: linear-gradient(to top, rgba(15,15,15,0.85), transparent);
    ">
        </div>

        <!-- Testo centrato -->
        <div
            style="
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 2rem;
    ">
            <p
                style="
            font-family: 'Jost', sans-serif;
            font-size: 0.72rem;
            font-weight: 400;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: rgba(200, 180, 140, 0.7);
            margin-bottom: 1rem;
        ">
                Backoffice</p>

            <h1
                style="
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.5rem, 6vw, 5rem);
            font-weight: 300;
            color: #f0ebe3;
            letter-spacing: 0.06em;
            line-height: 1.1;
            margin: 0 0 2rem;
            text-shadow: 0 2px 20px rgba(0,0,0,0.5);
        ">
                Officina 05<br>Acconciatori</h1>

            <a href="{{ route('appointments.index') }}"
                style="
            display: inline-block;
            font-family: 'Jost', sans-serif;
            font-size: 0.72rem;
            font-weight: 400;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #c8b48c;
            text-decoration: none;
            border: 1px solid rgba(200, 180, 140, 0.5);
            padding: 0.8rem 2rem;
            border-radius: 2px;
            transition: all 0.2s ease;
            background: rgba(200, 180, 140, 0.06);
        "
                onmouseover="this.style.background='rgba(200,180,140,0.15)'; this.style.borderColor='#c8b48c'"
                onmouseout="this.style.background='rgba(200,180,140,0.06)'; this.style.borderColor='rgba(200,180,140,0.5)'">
                Vai al Calendario →
            </a>
        </div>
    </div>
@endsection
