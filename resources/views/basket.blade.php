@extends('layouts.app')

@section('content')
    <div class="row">
        @if(count($order->products) != 0)
            @foreach($order->products as $product)
                <div class="col-lg-4 col-5 mt-4">
                    <div class="card align-items-center text-center">
                        <img src="{{Storage::url($product['img'])}}" class="card-img w-25 mt-2" alt="photo">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#" class="card-link">{{$product['name']}}</a></h5>
                            <p class="card-text">{{$product['description']}}</p>
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-dark">Количество: {{$product->pivot->count}} шт.</p>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{route('basketAdd', $product)}}" class="btn btn-sm btn-success">+</a>
                                    <a href="{{route('basketRemove', $product)}}" class="btn btn-sm btn-danger">-</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="text-dark">{{$product->getPriceForCount()}} руб.</p>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('basketDelete', $product)}}" class="btn btn-sm btn-danger">Удалить из корзины</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row mt-5 justify-content-around">
                <div class="col-6">
                    <h3>Общая стоимость заказа: {{$order->getFullPrice()}} руб.</h3>
                </div>
                <div class="col-6 text-end">
                    <a href="{{route('basketPlace')}}" class="btn btn-success">Оформить заказ</a>
                </div>
            </div>
        @else
            <div class="col-lg-12 col-12 mt-4 text-center">
                <h1>Корзина пуста</h1>
            </div>
        @endif
    </div>
@endsection
