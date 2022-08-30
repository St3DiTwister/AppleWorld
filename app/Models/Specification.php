<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasMany(Product::class, 'id', 'products_id');
    }

    public function property_values() {
        return $this->hasOne(PropertyValue::class, 'id', 'property_value_id');
    }

    public function property(){
        return $this->hasOne(Property::class, 'id', 'property_id');
    }
}
