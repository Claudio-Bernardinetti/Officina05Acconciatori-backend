@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.partials.sidebar')

            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center my-4">
                    <h2 class="fs-4 text-secondary mb-0">Prodotti</h2>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">+ Nuovo Prodotto</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Immagine</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Brand</th>
                                    <th>Prezzo</th>
                                    <th>In evidenza</th>
                                    <th>Attivo</th>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>
                                            @if ($product->image_path)
                                                <img src="{{ asset('storage/' . $product->image_path) }}" width="60"
                                                    height="60" style="object-fit:cover;" class="rounded">
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category ?? '—' }}</td>
                                        <td>{{ $product->brand ?? '—' }}</td>
                                        <td>{{ $product->price ? '€ ' . number_format($product->price, 2) : '—' }}</td>
                                        <td>{{ $product->featured ? '⭐' : '—' }}</td>
                                        <td>
                                            <span class="badge {{ $product->active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $product->active ? 'Sì' : 'No' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('products.edit', $product) }}"
                                                class="btn btn-sm btn-outline-primary">Modifica</a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Eliminare questo prodotto?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">Elimina</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">Nessun prodotto trovato.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
