@extends('layouts.app')

@section('title', 'Livros | Cantinho do Aconchego')

@section('content')
@php
    $bookCovers = [
        'A revolução dos Bichos' => 'revolucao-dos-bichos.jpg',
        'O Senhor dos Anéis' => 'senhor_aneis.webp',
        'A guerra que salvou minha vida' => 'a-guerra-da-vida.webp',
        '1984' => '1984.jpg',
        'A droga da obediência' => 'droga-obd.png',
        'Contos dos irmãos Grimm' => 'contos-irmãos-grimm.png',
    ];
@endphp

<section class="bookstore-promos" aria-label="Novidades da livraria">
    <div id="bookstorePromos" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5500">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#bookstorePromos" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Boas-vindas"></button>
            <button type="button" data-bs-target="#bookstorePromos" data-bs-slide-to="1" aria-label="Lançamentos"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/books/bem-vindo.jpeg') }}" class="d-block w-100" alt="Seja bem-vindo à nossa livraria, Cantinho do Aconchego">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/books/lançamentos.jpeg') }}" class="d-block w-100" alt="Lançamentos novos toda semana. Venha conferir!">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bookstorePromos" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bookstorePromos" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>
</section>

<section class="catalog-section">
    <div class="catalog-heading">
        <div>
            <p class="eyebrow">Um cantinho para chamar de seu</p>
            <h1>Nosso catálogo</h1>
            <p class="catalog-subtitle">Encontre sua próxima história favorita.</p>
        </div>
        @can('create-product')
            <a href="{{ route('products.create') }}" class="btn btn-bookstore">
                <i class="bi bi-plus-circle" aria-hidden="true"></i> Adicionar livro
            </a>
        @endcan
    </div>

    <div class="row g-4">
        @forelse ($products as $product)
            <div class="col-12 col-sm-6 col-lg-4">
                <article class="card book-card h-100">
                    <a class="book-cover" href="{{ route('products.show', $product->id) }}" aria-label="Ver {{ $product->name }}">
                        @if (isset($bookCovers[$product->name]))
                            <img src="{{ asset('images/books/' . $bookCovers[$product->name]) }}" alt="Capa do livro {{ $product->name }}" loading="lazy">
                        @else
                            <span class="book-cover-placeholder"><i class="bi bi-book-half" aria-hidden="true"></i></span>
                        @endif
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h2 class="book-title">{{ $product->name }}</h2>
                        <p class="book-description">{{ \Illuminate\Support\Str::limit($product->description, 115) }}</p>
                        @if ($product->price)
                            <p class="book-price">R$ {{ number_format((float) $product->price, 2, ',', '.') }}</p>
                        @endif
                        <div class="book-actions mt-auto">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-bookstore btn-sm">
                                <i class="bi bi-eye" aria-hidden="true"></i> Detalhes
                            </a>
                            @can('edit-product')
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-light-bookstore btn-sm" aria-label="Editar {{ $product->name }}">
                                    <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                </a>
                            @endcan
                            @can('delete-product')
                                <form action="{{ route('products.destroy', $product->id) }}" method="post" onsubmit="return confirm('Deseja excluir este livro?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light-bookstore btn-sm text-danger" aria-label="Excluir {{ $product->name }}">
                                        <i class="bi bi-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </article>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-catalog">
                    <i class="bi bi-book" aria-hidden="true"></i>
                    <p>Ainda não há livros no catálogo.</p>
                    @can('create-product')
                        <a href="{{ route('products.create') }}" class="btn btn-bookstore">Adicionar o primeiro livro</a>
                    @endcan
                </div>
            </div>
        @endforelse
    </div>

    <div class="catalog-pagination">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</section>
@endsection
