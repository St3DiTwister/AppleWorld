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
