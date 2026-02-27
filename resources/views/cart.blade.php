@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1 class="mb-4 text-white">Корзина</h1>
    
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Пользователь</th>
                <th scope="col">Товар</th>
                <th scope="col">Количество</th>
                <th scope="col">Действие</th>
            </tr>
        </thead>
        <tbody>
            @forelse($uu as $u)
                <tr>
                    <td>{{ $u->u_name }}</td>
                    <td>{{ $u->t_name }}</td>
                    <td>{{ $u->count }}</td>
                    <td>
                        <form method="POST" action="{{ route('delete_cart') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $u->product_id }}">
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Корзина пуста</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($uu->isNotEmpty())
        <a href="{{ route('add_order') }}">
            <button type="button" class="btn btn-light">Оформить заказ</button>
        </a>
    @endif
</div>
@endsection