<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function specification(){
        return $this->hasMany(Specification::class, 'products_id', 'id');
    }

    public function getPriceForCount(){
        if (!is_null($this->pivot)){
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    public function favourites(){
        return $this->hasOne(Favourite::class)->where('user_id', Auth::id());
    }
}
