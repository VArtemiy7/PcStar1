@extends('layouts.app')

@section('content')
<style>
.text-white-50 {
    color: rgba(255, 255, 255, 0.5);
}
</style>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-white">Каталог товаров</h1>
        
        <div class="d-flex gap-2 align-items-center">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if(request('sort') == 'price_asc')
                        Сначала дешевле
                    @elseif(request('sort') == 'price_desc')
                        Сначала дороже
                    @else
                        Сортировка по цене
                    @endif
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('catalog', ['sort' => 'price_asc']) }}">Сначала дешевле</a></li>
                    <li><a class="dropdown-item" href="{{ route('catalog', ['sort' => 'price_desc']) }}">Сначала дороже</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if(request('sort') == 'year_desc')
                        Сначала новые
                    @elseif(request('sort') == 'year_asc')
                        Сначала старые
                    @else
                        Сортировка по году
                    @endif
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('catalog', ['sort' => 'year_desc']) }}">Сначала новые</a></li>
                    <li><a class="dropdown-item" href="{{ route('catalog', ['sort' => 'year_asc']) }}">Сначала старые</a></li>
                </ul>
            </div>

            @if(request('sort'))
                <a href="{{ route('catalog') }}" class="btn btn-outline-danger">Сбросить фильтры</a>
            @endif
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach($myproducts as $product)
        <div class="col">
            <div class="card h-100">
                <img src="{{ asset('images/'.$product->img) }}" class="card-img-top" alt="...">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text-short_about flex-grow-1">{{ $product->about }}</p>
                    
                    <div class="mb-2">
                        <small class="text-white-50">Цена:</small>
                        <h3 class="card-text-price mb-0">{{ $product->price }} ₽</h3>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-white-50">Год выпуска:</small>
                        <p class="fs-5 text-white mb-0">{{ $product->year }}</p>
                    </div>
                    
                    <a href="{{ route('product', $product->id) }}" class="btn btn-primary w-100">К странице товара</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection