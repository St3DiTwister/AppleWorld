<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BasketConfirmRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function find_order(){
        $order = Order::get()->where('status', null)->where('user_id', Auth::id());
        if (count($order) == 0){
            $order = Order::create(['user_id' => Auth::id()]);
        } else {
            $order = $order->first();
        }
        session(['orderId' => $order->id]);
        return $order->id;
    }

    public function show(){
        $orderId = session('orderId');
        if (is_null($orderId)){
            $orderId = $this->find_order();
        }
        try {
            $order = Order::findOrFail($orderId);
        } catch (\Exception $e){
            session()->forget('orderId');
            return redirect()->route('main');
        }
        return view('basket', compact('order'));
    }

    public function add($productId){
        $order = session('orderId');
        if (is_null($order)){
            $orderId = $this->find_order();
            $order = Order::find($orderId);
        }
        else {
            $order = Order::find($order);
        }
        if ($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        }
        else {
            $order->products()->attach($productId);
        }
        session()->flash('basket_add', 'Товар добавлен в корзину!');
        return redirect()->back();
    }

    public function addPOST(Request $request){
        $order = session('orderId');
        if (is_null($order)){
            $orderId = $this->find_order();
            $order = Order::find($orderId);
        }
        else {
            $order = Order::find($order);
        }
        $products = $request->only('products');
        foreach ($products['products'] as $productId){
            if ($order->products->contains($productId)){
                $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
                $pivotRow->count++;
                $pivotRow->update();
            }
            else {
                $order->products()->attach($productId);
            }
        }
        session()->flash('basket_add', 'Товар добавлен в корзину!');
        return redirect()->back();
    }

    public function remove($productId){
        $order = Order::find(session('orderId'));
        if ($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2){
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        return redirect()->route('basket');

    }

    public function delete($productId)
    {
        $order = Order::find(session('orderId'));
        $order->products()->detach($productId);

        return redirect()->route('basket');
    }

    public function place(){
        return view('make_order');
    }

    public function confirm(BasketConfirmRequest $request){
        $orderId = session('orderId');
        if (is_null($orderId)){
            $orderId = $this->find_order();
        }
        $order = Order::findOrFail($orderId);
        $success = $order->saveOrder($request->telephone);
        if ($success){
            session()->flash('success', 'Ваш заказ принят в обработку!');
        } else {
            session()->flash('error', 'Что-то пошло не так...');
        }
        session()->forget('orderId');
        return redirect()->route('main');
    }
}
