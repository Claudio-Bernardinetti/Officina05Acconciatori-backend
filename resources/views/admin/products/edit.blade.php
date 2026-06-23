@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.partials.sidebar')

            <div class="col-md-10">
                <h2 class="fs-4 text-secondary my-4">Modifica Prodotto</h2>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Nome *</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $product->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Descrizione</label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Prezzo (€)</label>
                                    <input type="number" name="price" class="form-control" step="0.01"
                                        value="{{ old('price', $product->price) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Categoria</label>
                                    <input type="text" name="category" class="form-control"
                                        value="{{ old('category', $product->category) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Brand</label>
                                    <input type="text" name="brand" class="form-control"
                                        value="{{ old('brand', $product->brand) }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Immagine</label>
                                @if ($product->image_path)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $product->image_path) }}" width="100"
                                            class="rounded">
                                        <small class="text-muted ms-2">Immagine attuale</small>
                                    </div>
                                @endif
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-3 d-flex gap-4">
                                <div class="form-check">
                                    <input type="checkbox" name="featured" id="featured" class="form-check-input"
                                        {{ $product->featured ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featured">In evidenza</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="active" id="active" class="form-check-input"
                                        {{ $product->active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active">Attivo (visibile sul sito)</label>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Aggiorna</button>
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Annulla</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
