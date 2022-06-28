@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card-header">{{ __('Ваши заказы') }}</div>

                <div class="card-body">
                    @if(count($orders) != 0)
                    <div class="accordion accordion-flush" id="accordion">
                        @php($number = 1)
                        @foreach($orders as $order)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading{{$number}}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$number}}" aria-expanded="false" aria-controls="flush-collapse{{$number}}">
                                    Дата заказа: {{$order->updated_at}}<br>Статус: {{$order->status}}<br>Общая сумма: {{$order->total_price}}
                                </button>
                            </h2>
                            <div id="flush-collapse{{$number}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$number}}" data-bs-parent="#accordion">
                                <div class="accordion-body">
                                    <div class="row">
                                    @foreach($order->products as $product)
                                        <div class="col-lg-3 col-3 {{isset($cat_name) ? '' : 'mt-4'}} w-25 w-30 offset_helper">
                                            <a href="#" class="text-center text-decoration-none">
                                                <div class="card align-items-center w-auto h-100 card-border">
                                                    <img src="{{Storage::url($product['img'])}}" class="card-img w-50 mt-4" alt="photo">
                                                    <div class="card-body text-center w-100">
                                                        <h5 class="card-title fw-bold">{{$product['name']}}</h5>
                                                        <div class="row text-center align-items-center justify-content-center">
                                                            @php($thousands = (int)($product['price']/1000))
                                                            <div class="row text-center">
                                                                <div class="col-6">
                                                                    <p class="fs-4 fw-bold">{{$thousands . ' ' . mb_substr($product['price'], strlen($thousands))}} ₽</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <p class="fs-4 fw-bold">Кол-во: {{$product->pivot->count}} шт.</p>
                                                                </div>
                                                            </div>
                                                        </div>
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
                    </div>
                    @else
                        <div class="col-12 text-center">Заказы отсутствуют</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
