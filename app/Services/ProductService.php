<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductService {
    public function getSpecificationsArray($productId){
        $not_ready_mas = DB::table('specifications')
            ->leftJoin('property', 'property_id', '=', 'property.id')
            ->leftJoin('property_value', 'property_value_id', '=', 'property_value.id')
            ->leftJoin('property_categories', 'property_categories_id', '=', 'property_categories.id')
            ->where('products_id', $productId)
            ->orderBy('display_order')
            ->get();

        $mas = array();

        foreach ($not_ready_mas as $nrm) {
            $mas[$nrm->property_categories_name][$nrm->name] = $nrm->value;
        }

        return $mas;
    }

    public function getReviewsArray($productId){
        return DB::table('ratings')
            ->leftJoin('products', 'product_id', '=', 'products.id')
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->where('product_id', $productId)->get();
    }

    public function variables($product){
        $product_name = $product->name;

        $product_model = strstr($product_name, ',', true);
        $products = Product::where('name', 'like', $product_model.'%')->get();
        $variables = array();

        $current_product_array = explode('_', $product->slug);
        if (count($current_product_array) < 3) {
            return null;
        }
        foreach ($products as $product){
            $newest_product_array = explode('_', $product->slug);
            if ($current_product_array[2] == $newest_product_array[2]){
                $variables['color'][$product->slug] = $product->color;
            }
            if ($current_product_array[3] == $newest_product_array[3]){
                if (!is_numeric($newest_product_array[2])){
                    $variables['storage'][$product->slug] = $newest_product_array[3];
                } else {
                    $variables['storage'][$product->slug] = $newest_product_array[2];
                }
            }
        }
        return $variables;
    }
}
