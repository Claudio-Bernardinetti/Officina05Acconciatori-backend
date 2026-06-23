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
                justify-content: space-between;
                margin-bottom: 2rem;
                padding-bottom: 1.5rem;
                border-bottom: 1px solid rgba(200, 180, 140, 0.2);
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
                padding: 0.5rem 1.2rem;
                text-decoration: none;
                transition: all 0.2s;
            }

            .btn-gold:hover {
                background: rgba(200, 180, 140, 0.1);
                border-color: #c8b48c;
                color: #c8b48c;
            }

            .products-table {
                width: 100%;
                border-collapse: collapse;
            }

            .products-table th {
                font-size: 0.65rem;
                font-weight: 500;
                letter-spacing: 0.2em;
                text-transform: uppercase;
                color: rgba(200, 180, 140, 0.4);
                border-bottom: 1px solid rgba(200, 180, 140, 0.12);
                padding: 0.8rem 1rem;
                text-align: left;
            }

            .products-table td {
                padding: 1rem;
                border-bottom: 1px solid rgba(200, 180, 140, 0.06);
                font-size: 0.85rem;
                font-weight: 300;
                color: rgba(232, 224, 213, 0.8);
                vertical-align: middle;
            }

            .products-table tr:hover td {
                background: rgba(200, 180, 140, 0.03);
            }

            .badge-active {
                font-size: 0.65rem;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                padding: 0.25rem 0.6rem;
                border: 1px solid rgba(74, 158, 107, 0.4);
                color: #4a9e6b;
            }

            .badge-inactive {
                font-size: 0.65rem;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                padding: 0.25rem 0.6rem;
                border: 1px solid rgba(200, 180, 140, 0.2);
                color: rgba(200, 180, 140, 0.4);
            }

            .action-link {
                font-size: 0.72rem;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: rgba(200, 180, 140, 0.5);
                text-decoration: none;
                margin-right: 0.8rem;
                transition: color 0.2s;
            }

            .action-link:hover {
                color: #c8b48c;
            }

            .action-delete {
                background: none;
                border: none;
                font-size: 0.72rem;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: rgba(192, 82, 74, 0.5);
                cursor: pointer;
                padding: 0;
                transition: color 0.2s;
                font-family: 'Jost', sans-serif;
            }

            .action-delete:hover {
                color: #c0524a;
            }

            .alert-success {
                background: rgba(74, 158, 107, 0.1);
                border: 1px solid rgba(74, 158, 107, 0.3);
                color: #4a9e6b;
                padding: 0.8rem 1rem;
                margin-bottom: 1.5rem;
                font-size: 0.82rem;
                letter-spacing: 0.05em;
            }

            .empty-state {
                text-align: center;
                padding: 4rem;
                color: rgba(200, 180, 140, 0.3);
                font-size: 0.82rem;
                letter-spacing: 0.1em;
                text-transform: uppercase;
            }
        </style>
    </head>

    <div class="admin-wrapper">
        @include('admin.partials.sidebar')

        <div class="main-content">
            <div class="page-header">
                <div>
                    <div class="page-subtitle">Backoffice — Officina 05</div>
                    <h1 class="page-title">Prodotti</h1>
                </div>
                <a href="{{ route('products.create') }}" class="btn-gold">+ Nuovo Prodotto</a>
            </div>

            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <table class="products-table">
                <thead>
                    <tr>
                        <th>Immagine</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Brand</th>
                        <th>Prezzo</th>
                        <th>In evidenza</th>
                        <th>Stato</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                @if ($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}" width="56" height="56"
                                        style="object-fit:cover;">
                                @else
                                    <span style="color:rgba(200,180,140,0.2)">—</span>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category ?? '—' }}</td>
                            <td>{{ $product->brand ?? '—' }}</td>
                            <td>{{ $product->price ? '€ ' . number_format($product->price, 2) : '—' }}</td>
                            <td>{{ $product->featured ? '⭐' : '—' }}</td>
                            <td>
                                @if ($product->active)
                                    <span class="badge-active">Attivo</span>
                                @else
                                    <span class="badge-inactive">Inattivo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}" class="action-link">Modifica</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                    style="display:inline" onsubmit="return confirm('Eliminare questo prodotto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action-delete">Elimina</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">Nessun prodotto trovato</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
