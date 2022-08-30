<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BasketConfirmRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function show(){
        $order = $this->orderService->get_order();
        return view('basket', compact('order'));
    }

    public function add($productId){
        $this->orderService->add_to_order($productId);
        return redirect()->back();
    }

    public function addPOST(Request $request)
    {
        $this->orderService->add_to_order_postMethod($request->only('products'));
        return redirect()->back();
    }

    public function remove($productId){
        $this->orderService->remove_from_order($productId);
        return redirect()->route('basket');

    }

    public function delete($productId)
    {
        $this->orderService->detach_from_order($productId);
        return redirect()->route('basket');
    }

    public function place(){
        return view('make_order');
    }

    public function confirm(BasketConfirmRequest $request){
        $this->orderService->confirm_order($request->telephone);
        return redirect()->route('main');
    }
}
