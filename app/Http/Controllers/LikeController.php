<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Services\FavouriteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    protected $favouriteService;

    public function __construct(FavouriteService $favouriteService)
    {
        $this->favouriteService = $favouriteService;
    }

    public function like($productId){
        $favourites = $this->favouriteService->getFavourite($productId);
        if (count($favourites->get()) != 0){
            session()->flash('like_info', 'Товар уже в избранном');
        } else {
            Favourite::create(['user_id' => Auth::id(), 'product_id' => $productId]);
            session()->flash('like_success', 'Товар добавлен в избранное');
        }
        return redirect()->back();

    }

    public function unlike($productId){
        $favourites = $this->favouriteService->getFavourite($productId);
        if (count($favourites->get()) != 0){
            $favourites->delete();
            session()->flash('like_success', 'Товар удален из избранного');
        } else {
            session()->flash('like_info', 'Товар не был в избранном...');
        }
        return redirect()->back();
    }
}
