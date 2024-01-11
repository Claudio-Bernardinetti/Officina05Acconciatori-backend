@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 bg-dark vh-100 p-0">
            <ul class="p-0 px-2">
                <li class="btn btn-light p-3 w-100 my-3">{{ __('Calendario Appuntamenti') }}</li>
                <li class="btn btn-light p-3 w-100 mb-3">{{ __('Prodotti') }}</li>
                <li class="btn btn-light p-3 w-100 mb-3">{{ __('Aggiungi nuovi prodotti') }}</li>
                <li class="btn btn-light p-3 w-100">{{ __('Vai al negozzio') }}</li>
                <!-- Add more menu items here -->
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
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