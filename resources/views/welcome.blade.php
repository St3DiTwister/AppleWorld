@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card align-items-center">
                    <img src="{{Storage::url('products/headphones.jpg')}}" class="card-img w-25" alt="photo">
                    <div class="card-body">
                        <h5 class="card-title">AirPods</h5>
                        <p class="card-text">Новые наушники от компании Apple</p>
                        <div class="row text-center">
                            <div class="col">
                                <p class="text-dark">25.000 руб.</p>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="btn btn-success">В корзину</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
