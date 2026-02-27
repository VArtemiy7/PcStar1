@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1 class="mb-4 text-white">Заказы</h1>
    
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ФИО</th>
                <th scope="col">Статус</th>
                <th scope="col">Товары</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <th scope="row">{{ $order->id }}</th>
                    <td>
                        @if($order->product->isNotEmpty())
                            {{ $order->product[0]->user_name }} {{ $order->product[0]->user_surname }}
                        @else
                            <span class="text-muted">Нет данных</span>
                        @endif
                    </td>
                    <td>
                        @if($order->status == 'active')
                            <span class="badge bg-success">Активен</span>
                        @else
                            <span class="badge bg-secondary">Завершен</span>
                        @endif
                    </td>
                    <td>
                        @forelse($order->product as $product)
                            {{ $product->product_name }} - {{ $product->count }} шт<br>
                        @empty
                            <span class="text-muted">Нет товаров</span>
                        @endforelse
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Заказов нет</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection