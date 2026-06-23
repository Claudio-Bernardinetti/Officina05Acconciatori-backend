@extends('layouts.app')

@section('content')
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

        .page-header {
            display: flex;
            align-items: flex-end;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(200, 180, 140, 0.2);
        }

        .form-card {
            background: #111;
            border: 1px solid rgba(200, 180, 140, 0.12);
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(200, 180, 140, 0.5);
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            background: #1a1a1a;
            border: 1px solid rgba(200, 180, 140, 0.15);
            color: #e8e0d5;
            padding: 0.6rem 0.8rem;
            font-family: 'Jost', sans-serif;
            font-size: 0.85rem;
            font-weight: 300;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: rgba(200, 180, 140, 0.4);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1rem;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 0.5rem;
        }

        .form-check input {
            accent-color: #c8b48c;
        }

        .form-check label {
            font-size: 0.82rem;
            font-weight: 300;
            color: rgba(232, 224, 213, 0.7);
            letter-spacing: 0.03em;
        }

        .btn-gold {
            background: transparent;
            border: 1px solid rgba(200, 180, 140, 0.4);
            color: #c8b48c;
            font-family: 'Jost', sans-serif;
            font-size: 0.75rem;
            font-weight: 400;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.6rem 1.5rem;
            cursor: pointer;
            transition: all 0.2s;
            margin-right: 0.8rem;
        }

        .btn-gold:hover {
            background: rgba(200, 180, 140, 0.1);
            border-color: #c8b48c;
        }

        .btn-ghost {
            background: transparent;
            border: 1px solid rgba(200, 180, 140, 0.15);
            color: rgba(200, 180, 140, 0.4);
            font-family: 'Jost', sans-serif;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.6rem 1.5rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-ghost:hover {
            border-color: rgba(200, 180, 140, 0.3);
            color: rgba(200, 180, 140, 0.7);
        }

        .alert-danger {
            background: rgba(192, 82, 74, 0.1);
            border: 1px solid rgba(192, 82, 74, 0.3);
            color: #c0524a;
            padding: 0.8rem 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.82rem;
        }

        .alert-danger ul {
            margin: 0;
            padding-left: 1rem;
        }
    </style>

    <div class="admin-wrapper">
        @include('admin.partials.sidebar')

        <div class="main-content">
            <div class="page-header">
                <div>
                    <div class="page-subtitle">Prodotti</div>
                    <h1 class="page-title">Nuovo Prodotto</h1>
                </div>
            </div>

            <div class="form-card">
                @if ($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Nome *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Descrizione</label>
                        <textarea name="description" class="form-control" rows="4" style="resize:vertical">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-row" style="margin-bottom:1.5rem">
                        <div class="form-group" style="margin-bottom:0">
                            <label class="form-label">Prezzo (€)</label>
                            <input type="number" name="price" class="form-control" step="0.01"
                                value="{{ old('price') }}">
                        </div>
                        <div class="form-group" style="margin-bottom:0">
                            <label class="form-label">Categoria</label>
                            <input type="text" name="category" class="form-control" value="{{ old('category') }}">
                        </div>
                        <div class="form-group" style="margin-bottom:0">
                            <label class="form-label">Brand</label>
                            <input type="text" name="brand" class="form-control" value="{{ old('brand') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Immagine</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div style="margin-bottom:1.5rem">
                        <div class="form-check">
                            <input type="checkbox" name="featured" id="featured" {{ old('featured') ? 'checked' : '' }}>
                            <label for="featured">In evidenza</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="active" id="active" checked>
                            <label for="active">Attivo (visibile sul sito)</label>
                        </div>
                    </div>

                    <div style="display:flex; align-items:center; gap:1rem">
                        <button type="submit" class="btn-gold">Salva</button>
                        <a href="{{ route('products.index') }}" class="btn-ghost">Annulla</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
