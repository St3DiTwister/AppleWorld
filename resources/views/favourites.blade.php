@extends('layouts.app')

@section('content')
    <div class="row">
        @if(count($favourites) != 0)
            <h2 class="ms-3">Избранное</h2>
            <div class="col-9 wrapper">
                @foreach($favourites as $products)
                    @php($product = $products->product)
                    <div class="col-5 col-lg-5 mt-5 ms-3">
                        <div class="row m-0">
                            <a href="#" class="text-center text-decoration-none">
                                <div class="col-10">
                                    <div class="card align-items-center text-center card-border" id="card_{{$product->id}}">
                                        <img src="{{Storage::url($product['img'])}}" class="card-img w-50 mt-4" alt="photo">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="{{route('product', $product->slug)}}" class="text-decoration-none">{{$product['name']}}</a></h5>
                                            <p class="fs-4 fw-bold">@price_format($product['price']) руб.</p>
                                            <p hidden id="price_{{$product->id}}">{{$product['price']}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 position-relative mt-3">
                                    <div class="h-75 text-center">
                                        <div class="mb-3">
                                            <input type="checkbox" class="btn basket-link btn-radius align-items-center btn-group-vertical custom-checkbox" id="{{$product->id}}" value="{{$product->id}}">
                                            <label for="{{$product->id}}"></label>
                                        </div>
                                    </div>
                                    <div class="h-25">
                                        <div>
                                            <a href="{{route('unlike', $product)}}" class="basket-link btn-warning position-absolute bottom-0 btn-radius align-items-center btn-group-vertical"><img src="{{asset('img/unlike.svg')}}"/></a>
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
                    <p class="w-50 fw-bold fs-5" id="total_count"><span>0</span> товаров</p>
                    <p class="w-50 text-end fw-bold fs-5" id="total_price"><span>0</span> ₽</p>
                </div>
                <a class="btn btn-success w-100" id="send">Добавить в корзину</a>
            </div>
        @else
            <div class="col-lg-12 col-12 mt-4 text-center">
                <h1>Нет избранных</h1>
            </div>
        @endif
    </div>

    <script>
        let selectedProducts = [];

        $(function () {
            let checkboxes = document.getElementsByClassName('custom-checkbox');
            for (let index = 0; index < checkboxes.length; index++) {
                $('#' + checkboxes[index].id).prop('checked', false).on('change', function () {
                    let card_elem = $('#card_' + checkboxes[index].id);
                    let total_price_elem = $('#total_price > span');
                    let price_elem = $('#price_' + checkboxes[index].id);
                    let total_count = $('#total_count > span');
                    if (this.checked) {
                        selectedProducts.push(Number(checkboxes[index].id));
                        card_elem.addClass('card-border-selected');
                        total_price_elem.html(Number(total_price_elem.html()) + Number(price_elem.html()));
                    } else {
                        selectedProducts.splice(selectedProducts.indexOf(Number(checkboxes[index].id)), 1);
                        card_elem.removeClass('card-border-selected');
                        total_price_elem.html(Number(total_price_elem.html()) - Number(price_elem.html()));
                    }
                    total_count.html(selectedProducts.length)
                })
            }
            $('#send').click(function () {
                $.ajax({
                    type: 'POST',
                    url: "{{route('basketAddPOST')}}",
                    data: {'_token': $('meta[name="csrf-token"]').attr('content'), 'products': selectedProducts},
                    success: function () {
                        toastr.success('Товар успешно добавлен в корзину!');
                        unchecked();
                    },
                });
            });
        });

        function unchecked() {
            let checkboxes = document.getElementsByClassName('custom-checkbox');
            for (let index = 0; index < checkboxes.length; index++) {
                let elem = $('#' + checkboxes[index].id);
                if (elem.prop('checked')) {
                    elem.prop('checked', false).change();
                }
            }
        }
    </script>
@endsection
