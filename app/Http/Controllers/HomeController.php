<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::orderBy('updated_at', 'desc')->where('user_id', Auth::id())->whereNotNull('status')->get();
        return view('home', compact('orders'));
    }

    public function category($slug){
        $cat = Category::where('slug', $slug)->first();
        $products = Product::all()->where('category_id', $cat->id);
        $cat_name = $cat->name;
        return view('main', compact('products', 'cat_name'));
    }
}
