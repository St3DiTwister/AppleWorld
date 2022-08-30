@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 ms-4">
            <h2>Ваши заказы</h2>
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                    @if(count($orders) != 0)
                    <div class="accordion accordion-flush" id="accordion">
                        @php($number = 1)
                        @foreach($orders as $order)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading{{$number}}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$number}}" aria-expanded="false" aria-controls="flush-collapse{{$number}}">
                                    <span class="row w-100 wrapper">
                                        <span class="col-6">
                                            <span class="d-block mb-3">{{$order->updated_at}}</span>
                                            <span class="order-status">{{$order->status}}</span>
                                        </span>
                                        <span class="col-5 text-end w-50">
                                            <span class="d-block mb-3 me-5">Цена: <b>@price_format($order->total_price) ₽</b></span>
                                            <span class="me-5">Товаров: {{$order->getCount()}} шт.</span>
                                        </span>
                                    </span>
                                </button>
                            </h2>
                            <div id="flush-collapse{{$number}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$number}}" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="row">
                                    @foreach($order->products as $product)
                                        <div class="col-lg-3 col-3 {{isset($cat_name) ? '' : 'mt-4'}} w-25 w-30 offset_helper">
                                            <a href="{{route('product', $product['slug'])}}" class="text-center text-decoration-none">
                                                <div class="card align-items-center text-center card-border">
                                                    <img src="{{Storage::url($product['img'])}}" class="card-img w-50 mt-4" alt="photo">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><a href="#" class="text-decoration-none">{{$product['name']}}</a></h5>
                                                        <p class="fs-4 fw-bold">@price_format($product->getPriceForCount()) ₽</p>
                                                        <p class="fs-5">Количество: {{$product->pivot->count}} шт.</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php($number++)
                        @endforeach
                    @else
                        <div class="col-12 text-center">Заказы отсутствуют</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
