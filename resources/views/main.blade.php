@extends('layouts.app')

@section('content')
    @if(isset($cat_name))
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('main')}}">Главная</a></li>
                <li class="breadcrumb-item active"><a class="text-decoration-none" href="{{route('categories')}}">Категории</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$cat_name}}</li>
            </ol>
        </nav>
    @endif
    <div class="row w-100">
        <div class="col-3 {{isset($cat_name) ? '' : 'mt-4'}}">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Наличие в магазинах
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                     В наличии
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Не в наличии
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Цена
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">От</span>
                                <input type="number" class="form-control" aria-label="Пример размера поля ввода" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">До</span>
                                <input type="number" class="form-control" aria-label="Пример размера поля ввода" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Год релиза
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h1>Body</h1>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                            Серия
                        </button>
                    </h2>
                    <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h1>Body</h1>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading5">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                            Диагональ
                        </button>
                    </h2>
                    <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h1>Body</h1>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading6">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                            Память
                        </button>
                    </h2>
                    <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h1>Body</h1>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading7">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                            Материал
                        </button>
                    </h2>
                    <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h1>Body</h1>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading8">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                            Количество камер
                        </button>
                    </h2>
                    <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h1>Body</h1>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading9">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                            Цвет
                        </button>
                    </h2>
                    <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <h1>Body</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-danger w-100 mt-2">Сброс</button>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-success w-100 mt-2">Применить</button>
                </div>
            </div>
        </div>
        <div class="col-9 wrapper">
            @foreach($products as $product)
                <div class="col-lg-3 col-3 {{isset($cat_name) ? '' : 'mt-4'}} w-30 offset_helper">
                    <a href="{{route('product', $product['slug'])}}" class="text-center text-decoration-none">
                    <div class="card align-items-center w-auto card-border mb-4">
                        <img src="{{Storage::url($product['img'])}}" class="card-img w-100 mt-4" height="160px" alt="photo">
                        <div class="card-body text-center w-100 pb-5">
                            <h5 class="card-title fw-bold">{{$product['name']}}</h5>
                            <div class="row text-center align-items-center justify-content-center">
                                <p class="fs-4 fw-bold">@price_format($product['price']) ₽</p>
                                <div class="ms-sm-5 row align-items-center justify-content-center">
                                    <div class="col-2">
                                        @if(!is_null($product->favourites))
                                            <a href="{{route('unlike', $product)}}"><img src="{{asset('img/liked.svg')}}"></a>
                                        @else
                                            <a href="{{route('like', $product)}}"><img src="{{asset('img/unliked.svg')}}"></a>
                                        @endif
                                    </div>
                                    <div class="col-10">
                                        <a href="{{route('basketAdd', $product)}}" class="btn w-75 p-2 btn-success">В корзину</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach
            @if(count($products) == 0)
                <h3 class="text-center mt-5">Товаров не найдено</h3>
            @endif
        </div>
    </div>
@endsection
