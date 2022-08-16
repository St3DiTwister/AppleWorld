<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function main()
    {
        if (isset($_GET['search'])) {
            $products = Product::where('name', 'like', '%'.$_GET['search'].'%')->get();
        }
        else {
            $products = Product::all();
        }
        return view('main', compact('products'));
    }

    public function show_categories()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    public function category($slug) {
        $cat = Category::where('slug', $slug)->first();
        $products = Product::all()->where('category_id', $cat->id);
        $cat_name = $cat->name;
        return view('main', compact('products', 'cat_name'));
    }

    public function favourites(){
        $favourites = User::find(Auth::id())->favourites;
        return view('favourites', compact('favourites'));
    }

    public function product($slug){
        $product = Product::where('slug', $slug)->first();
        return view('product', compact('product'));
    }
}
