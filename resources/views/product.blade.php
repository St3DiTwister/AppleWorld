@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-5">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('main')}}">Главная</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('categories')}}">Категории</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('category', $product['category']->slug)}}">{{$product['category']->name}}</a></li>
            <li class="breadcrumb-item active"><a class="text-decoration-none">{{$product['name']}}</a></li>
        </ol>
    </nav>
    <div class="row w-100">
        <div class="col-6">
            <div class="row">
                <div class="col-3">
                    <div class="flex-column slider-background mt-3">
                        <button class="btn"><img src="{{Storage::url($product['img'])}}" class="card-img w-50 mb-4 mt-4 slider-active" alt="photo"></button>
                        <button class="btn"><img src="/storage/products/iphone_13_128_blue_2.png" class="card-img w-50 mb-4" alt="photo"></button>
                        <button class="btn"><img src="/storage/products/iphone_13_128_blue_3.png" class="card-img w-50 mb-4" alt="photo"></button>
                        <button class="btn"><img src="/storage/products/iphone_13_128_blue_4.png" class="card-img w-50 mb-4" alt="photo"></button>
                    </div>
                </div>
                <div class="col-8 mx-lg-4 text-center align-items-center">
                    <img src="{{Storage::url($product['img'])}}" class="mt-3" height="85%" alt="photo" id="main_photo">
                </div>
            </div>
        </div>
        <div class="col-6 mt-4">
            <p class="fs-3 fw-bolder mb-4">{{$product->name}}</p>
            <div class="row mt-4 mb-4">
                <div class="col-1">
                    <p class="fs-5 fw-bolder">Цвет</p>
                </div>
                <div class="col-10 mx-4">
                    <a href="#" class="product_variable product_variable_active m-md-2"><p style="background: #266584;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></a>
                    <a href="#" class="product_variable m-md-2"><p style="background: #BB4443;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></a>
                    <a href="#" class="product_variable m-md-2"><p style="background: #3D3D3D;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></a>
                </div>
            </div>
            <div class="row mb-4 mt-4">
                <div class="col-2">
                    <p class="fs-5 fw-bolder">Накопитель</p>
                </div>
                <div class="col-9 mx-4">
                    <a href="#" class="product_storage public_storage_active">128 ГБ</a>
                    <a href="#" class="product_storage">256 ГБ</a>
                    <a href="#" class="product_storage">512 ГБ</a>
                </div>
            </div>
            <p class="fs-2 fw-bold mb-4">@price_format($product['price']) ₽</p>
            <div class="row">
                <div class="col-5">
                    <a href="{{route('basketAdd', $product)}}" class="btn w-100 btn-success fs-4 fw-normal buy_button_product_page">Добавить в корзину</a>
                </div>
                <div class="col-2 mt-3 fix-margin">
                    <a href="{{route('like', $product)}}" class="product_button_border"><img src="{{asset('img/unliked_grey.svg')}}"></a>
                </div>
                <div class="col-2 mt-3">
                    <a href="{{route('like', $product)}}" class="product_button_border"><img src="{{asset('img/comparison_grey.svg')}}"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="row product_navbar">
            <div class="col-3">
                <button class="btn fs-3" id="specifications_switch">Характеристики</button>
            </div>
            <div class="col-3">
                <button class="btn fs-3 not_active" id="reviews_switch">Отзывы (1)</button>
            </div>
            <div class="col-6 text-end">
                <button class="btn fs-4" id="review_button" data-bs-toggle="modal" data-bs-target="#exampleModal" style="visibility: hidden;">Оставить отзыв <img src="{{asset('img/write_review.svg')}}"></button>
            </div>
        </div>
        <div class="row product_specifications" id="product_specifications">
            <div class="row mx-1 mt-4">
                <div class="col-4">
                    <h3>Основные характеристики</h3>
                </div>
                <div class="col-8 ">
                    <div class="row">
                        <div class="col-6">
                            <p>Память</p>
                        </div>
                        <div class="col-6">
                            <p>128 ГБ</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p>Цвет</p>
                        </div>
                        <div class="col-6">
                            <p>синий</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-1 mt-4">
                <div class="col-4">
                    <h3>Процессор</h3>
                </div>
                <div class="col-8 ">
                    <div class="row">
                        <div class="col-6">
                            <p>Процессор</p>
                        </div>
                        <div class="col-6">
                            <p>A15 Bionic</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-1 mt-4">
                <div class="col-4">
                    <h3>Дисплей</h3>
                </div>
                <div class="col-8 ">
                    <div class="row">
                        <div class="col-6">
                            <p>Диагональ</p>
                        </div>
                        <div class="col-6">
                            <p>6.1"</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p>Разрешение</p>
                        </div>
                        <div class="col-6">
                            <p>2532x1170</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p>Яркость</p>
                        </div>
                        <div class="col-6">
                            <p>800 кд/м²</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p>Контрастность</p>
                        </div>
                        <div class="col-6">
                            <p>20000000:1</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p>Плотность пикселей на дюйм</p>
                        </div>
                        <div class="col-6">
                            <p>460 пикс/дюйм</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p>Тип дисплея</p>
                        </div>
                        <div class="col-6">
                            <p>OLED</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p>Технологии дисплея</p>
                        </div>
                        <div class="col-6">
                            <p>True tone</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-1 mt-4">
                <div class="col-4">
                    <h3>Основные характеристики</h3>
                </div>
                <div class="col-8 ">
                    <div class="row">
                        <div class="col-6">
                            <p>Память</p>
                        </div>
                        <div class="col-6">
                            <p>128 ГБ</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p>Цвет</p>
                        </div>
                        <div class="col-6">
                            <p>синий</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row product_reviews" id="product_reviews">
            <div class="row mx-1 mt-4">
                <div class="col-2">
                    <h3>Евгения</h3>
                    <div class="rating-result">
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div class="col-10">
                    <div class="row">
                        <div class="col-6">
                            <p class="review_header">Отзыв о модели Apple Iphone 13, 512 ГБ, синий</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="review_header">26.09.2021</p>
                        </div>
                        <p class="fs-4">Однозначно это моя последняя модель, и многие друзья также разочарованы в покупке. Камеры телефонов за 30к работают получше, эппл пей не работает, компания плюет на пользователей,
                            убирают по своему желанию приложения, убирают оплату картами, никакой надежности нет в том что завтра твой телефон не превратится в кирпич. Если дорожите своими нервами и деньгами,
                            берите Самсунг, на поверку он оказался гораздо лучшим решением и более преданным своим пользователям.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="mt-3">
                    <h5 class="modal-title text-center fw-bold" id="exampleModalLabel">Оставить отзыв</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body">
                            @csrf
                            <textarea name="review" cols="55" rows="5" placeholder="Отзыв" required class="modal_textarea"></textarea>
                    </div>
                    <div class="mb-4 m-2">
                        <div class="rating-area">
                            <button type="button" class="btn btn-success">Отправить</button>
                            <input type="radio" id="star-5" name="rating" value="5">
                            <label for="star-5" title="Оценка «5»"></label>
                            <input type="radio" id="star-4" name="rating" value="4">
                            <label for="star-4" title="Оценка «4»"></label>
                            <input type="radio" id="star-3" name="rating" value="3">
                            <label for="star-3" title="Оценка «3»"></label>
                            <input type="radio" id="star-2" name="rating" value="2">
                            <label for="star-2" title="Оценка «2»"></label>
                            <input type="radio" id="star-1" name="rating" value="1">
                            <label for="star-1" title="Оценка «1»"></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            const allSlidersButtons = document.querySelectorAll('.card-img');
            allSlidersButtons.forEach(el=>el.addEventListener('click',function(e){
                e.preventDefault();
                let slide_active = $('.slider-active');
                slide_active.removeClass('slider-active');
                $(el).addClass('slider-active');
                let main_photo = document.getElementById('main_photo');
                main_photo.src = el.getAttribute('src');
            }));
        });

        let product_specifications = document.getElementById('product_specifications');
        let product_reviews = document.getElementById('product_reviews');
        let review_button = document.getElementById('review_button');
        $('#specifications_switch').on('click', function () {
            product_specifications.style.display = 'block';
            product_reviews.style.display = 'none';
            review_button.style.visibility = 'hidden';
            $(this).removeClass('not_active');
            $('#reviews_switch').addClass('not_active');
        });
        $('#reviews_switch').on('click', function () {
            product_reviews.style.display = 'block';
            product_specifications.style.display = 'none';
            review_button.style.visibility = 'visible';
            $(this).removeClass('not_active');
            $('#specifications_switch').addClass('not_active');
        })
    </script>
@endsection
