<?php

namespace App\Services;


use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;

class FavouriteService
{
    public function getFavourite($productId){
        return Favourite::where('user_id', Auth::id())->where('product_id', $productId);
    }
}
