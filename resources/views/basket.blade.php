@extends('layouts.app')

@section('content')
    <div class="row">
        @if(count($order->products) != 0)
            <h2 class="ms-3">Корзина</h2>
            <div class="col-9 wrapper">
                @foreach($order->products as $product)
                    <div class="col-5 col-lg-5 mt-5 ms-3">
                        <div class="row m-0">
                            <a href="#" class="text-center text-decoration-none">
                                <div class="col-10">
                                    <div class="card align-items-center text-center card-border">
                                        <img src="{{Storage::url($product['img'])}}" class="card-img w-50 mt-4" alt="photo">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="#" class="text-decoration-none">{{$product['name']}}</a></h5>
                                            <p class="fs-4 fw-bold">@price_format($product->getPriceForCount()) руб.</p>
                                            <p class="fs-5">Количество: {{$product->pivot->count}} шт.</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-2 position-relative mt-3">
                                    <div class="h-75 text-center">
                                        <div class="mb-3">
                                            <a href="{{route('basketAdd', $product)}}" class="btn basket-link btn-success btn-radius align-items-center btn-group-vertical"><img src="{{asset('img/plus.svg')}}"/></a>
                                        </div>
                                        <div>
                                            <a href="{{route('basketRemove', $product)}}" class="btn basket-link btn-success btn-radius align-items-center btn-group-vertical"><img src="{{asset('img/minus.svg')}}"/></a>
                                        </div>
                                    </div>
                                    <div class="h-25">
                                        <div>
                                            <a href="{{route('basketDelete', $product)}}" class="basket-link btn-warning position-absolute bottom-0 btn-radius ms-2 align-items-center btn-group-vertical"><img src="{{asset('img/delete.svg')}}"/></a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-3 card-border p-5 h-50">
                <h5>Итого:</h5>
                <div class="row justify-content-end">
                    <p class="w-50 fw-bold fs-5">{{$order->getPluralcount(['товар', 'товара', 'товаров'])}}</p>
                    <p class="w-50 text-end fw-bold fs-5">@price_format($order->getFullPrice()) ₽</p>
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
