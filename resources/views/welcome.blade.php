@extends('layouts.app')
@section('content')

<div class="card rounded-0 bg-dark text-white d-flex align-items-center justify-content-center"
        style="height: calc(100vh - 68px); overflow: hidden;">
        <img src="{{ asset('assets/img/o05a-back-office.jpg') }}" alt="" style="object-fit: cover; width: 100%; height: 100%;">
        <div class="card-img-overlay d-flex flex-column align-items-center justify-content-center">
            <div class="rounded" style="background-color: rgba(0, 0, 0, 0.5); padding: 16px;">
                <h1 class="p-4">Welcome to Officina 05 Acconciatori Back-Office</h1>
            </div>
        </div>
</div>
@endsection