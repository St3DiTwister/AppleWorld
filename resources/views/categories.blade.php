@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{route('main')}}">Главная</a></li>
            <li class="breadcrumb-item active"><a class="text-decoration-none" href="{{route('categories')}}">Категории</a></li>
        </ol>
    </nav>
    <div class="row flex-wrap">
        @foreach($categories as $category)
            <div class="col-3 mb-5">
                <a href="{{route('category', $category['slug'])}}" class="card-link text-decoration-none">
                    <div class="card align-items-center card-border p-4 h-100 align-baseline">
                        <img src="{{Storage::url($category['img'])}}" class="card-img w-auto" alt="photo">
                        <h5 class="card-title pt-4 fs-3 fw-bold">{{$category['name']}}</h5>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
