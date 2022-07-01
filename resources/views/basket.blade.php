@extends('layouts.app')

@section('content')
    <div class="row">
        @if(count($order->products) != 0)
            <h2 class="ms-3">Корзина</h2>
            <div class="col-9 wrapper">
                @foreach($order->products as $product)
                    <div class="col-5 col-lg-5 mt-5 ms-5">
                        <div class="row">
                            <a href="#" class="text-center text-decoration-none">
                                <div class="col-10">
                                    <div class="card align-items-center text-center card-border">
                                        <img src="{{Storage::url($product['img'])}}" class="card-img w-50 mt-2" alt="photo">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="#" class="text-decoration-none">{{$product['name']}}</a></h5>
                                            <p class="fs-4 fw-bold">{{number_format($product->getPriceForCount(), 0, ',', ' ')}} руб.</p>
                                            <p class="fs-5">Количество: {{$product->pivot->count}} шт.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 flex-column position-relative">
                                    <div class="h-75 text-center align-items-center">
                                        <a href="{{route('basketAdd', $product)}}" class="btn btn-success w-100 py-3 btn-radius"><img src="{{asset('img/plus.png')}}"/></a>
                                        <a href="{{route('basketRemove', $product)}}" class="btn btn-success w-100 mt-2 text-center align-items-center py-3 btn-radius"><img src="{{asset('img/minus.png')}}"/></a>
                                    </div>
                                    <div class="h-25">
                                        <a href="{{route('basketDelete', $product)}}" class="btn btn-warning w-75 bottom-0 position-absolute py-3 btn-radius"><img src="{{asset('img/delete.png')}}"/></a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-3">
                <h5>Итого:</h5>
                <div class="row justify-content-end">
                    <p class="w-50 fw-bold fs-5">{{$order->getPluralcount(['товар', 'товара', 'товаров'])}}</p>
                    <p class="w-50 text-end fw-bold` fs-5">{{number_format($order->getFullPrice(), 0, ',', ' ')}} ₽</p>
                </div>
                <a href="{{route('basketPlace')}}" class="btn btn-success w-100">Перейти к оформлению</a>
            </div>
        @else
            <div class="col-lg-12 col-12 mt-4 text-center">
                <h1>Корзина пуста</h1>
            </div>
        @endif
    </div>
@endsection

{{--@section('content')--}}
{{--    <div class="row">--}}
{{--        @if(count($order->products) != 0)--}}
{{--            @foreach($order->products as $product)--}}
{{--                <div class="col-lg-4 col-5 mt-4">--}}
{{--                    <div class="card align-items-center text-center">--}}
{{--                        <img src="{{Storage::url($product['img'])}}" class="card-img w-25 mt-2" alt="photo">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title"><a href="#" class="card-link">{{$product['name']}}</a></h5>--}}
{{--                            <p class="card-text">{{$product['description']}}</p>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-8">--}}
{{--                                    <p class="text-dark">Количество: {{$product->pivot->count}} шт.</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <a href="{{route('basketAdd', $product)}}" class="btn btn-sm btn-success">+</a>--}}
{{--                                    <a href="{{route('basketRemove', $product)}}" class="btn btn-sm btn-danger">-</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col">--}}
{{--                                    <p class="text-dark">{{$product->getPriceForCount()}} руб.</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <a href="{{route('basketDelete', $product)}}" class="btn btn-sm btn-danger">Удалить из корзины</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--            <div class="row mt-5 justify-content-around">--}}
{{--                <div class="col-6">--}}
{{--                    <h3>Общая стоимость заказа: {{$order->getFullPrice()}} руб.</h3>--}}
{{--                </div>--}}
{{--                <div class="col-6 text-end">--}}
{{--                    <a href="{{route('basketPlace')}}" class="btn btn-success">Оформить заказ</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="col-lg-12 col-12 mt-4 text-center">--}}
{{--                <h1>Корзина пуста</h1>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--@endsection--}}
