@extends('layouts.app')

@section('content')
<style>
.text-white-50 {
    color: rgba(255, 255, 255, 0.5);
}
.text-success {
    color: #00e300 !important;
}
.card-h-100-medium {
    max-width: 600px;
    margin: 0 auto;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            @foreach($myproducts as $product)
            <div class="card-h-100-medium p-4">
                <img src="{{ asset('images/' . $product->img) }}" class="card-img-top rounded-3 mb-3" alt="{{ $product->name }}" style="max-height: 300px; object-fit: contain;">
                
                <div class="card-body p-0">
                    <h2 class="card-title-product fs-3 mb-3">{{ $product->name }}</h2>
                    
                    <div class="mb-3">
                        <small class="text-white-50">Наименование:</small>
                        <p class="product-h4 fs-5">{{ $product->name }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-white-50">Цена:</small>
                        <p class="product-h4 fs-4 text-success">{{ number_format($product->price, 0, '', ' ') }} ₽</p>
                    </div>
                    
                    <div class="mb-4">
                        <small class="text-white-50">О системе:</small>
                        <p class="product-h4 fs-5">{{ $product->about }}</p>
                    </div>

                    <form method="post" action="{{ route('add_cart') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary w-100 py-2">Добавить в корзину</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection