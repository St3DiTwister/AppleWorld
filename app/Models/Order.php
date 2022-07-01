<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'status'];

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function getCount(){
        $count = 0;
        foreach ($this->products as $product){
            $count += $product->pivot->count;
        }
        return $count;
    }

    public function getPluralCount($str){
        $number = $this->getCount();
        $cases = array (2, 0, 1, 1, 1, 2);
        return $number.' '.$str[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
    }

    public function getFullPrice(){
        $sum = 0;
        foreach ($this->products as $product){
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }

    public function saveOrder($telephone){
        if ($this->status == null){
            $this->telephone = $telephone;
            $this->status = 'Новый';
            $this->total_price = $this->getFullPrice();
            $this->save();
            session()->forget('orderId');
            return true;
        } else {
            return false;
        }
    }
}
