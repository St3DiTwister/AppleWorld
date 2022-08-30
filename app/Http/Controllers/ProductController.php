<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function product($slug){
        $product = Product::where('slug', $slug)->first();

        $mas = $this->productService->getSpecificationsArray($product->id);
        $reviews = $this->productService->getReviewsArray($product->id);
        $variables = $this->productService->variables($product);

        return view('product', compact('product', 'mas', 'reviews', 'variables'));
    }

    public function reviewSend(Request $request, $slug){
        $product = Product::where('slug', $slug)->first();
        DB::table('ratings')->insert([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'review' => $request->review,
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);
        return redirect()->back();
    }
}
