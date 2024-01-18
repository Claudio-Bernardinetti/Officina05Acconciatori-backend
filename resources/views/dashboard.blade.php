@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 bg-dark vh-100 p-0">
            <ul class="  p-0 px-2">
                <li ><a class="btn btn-light p-3 w-100 my-3" href="{{ route('appointments.index') }}">Calendario Appuntamenti </a> </li>
                <li ><a class="btn btn-light p-3 w-100 mb-3" href="">Prodotti</a></li>
                <li ><a class="btn btn-light p-3 w-100 mb-3" href="">Aggiungi nuovi prodotti</a></li>
                <li ><a class="btn btn-light p-3 w-100" href="">Vai al negozzio</a></li>
                <!-- Add more menu items here -->
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-10">
            <h2 class="fs-4 text-secondary my-4">
                {{ __('Dashboard') }}
            </h2>
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection