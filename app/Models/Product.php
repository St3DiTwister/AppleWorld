<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function getPriceForCount(){
        if (!is_null($this->pivot)){
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }
}
