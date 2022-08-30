<?php


namespace App\Services;


use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderService
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

    public function get_order(){
        $orderId = session('orderId');

        if (is_null($orderId)){
            $orderId = $this->find_order();
        }
        try {
            return Order::findOrFail($orderId);
        } catch (\Exception $e){
            session()->forget('orderId');
            return redirect()->route('main');
        }
    }

    public function product_is_there($order, $productId){
        return $order->products->contains($productId);
    }

    public function adding_action($order, $productId){
        if ($this->product_is_there($order, $productId)){
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        }
        else {
            $order->products()->attach($productId);
        }
    }

    public function remove_from_order($productId){
        $order = $this->get_order();
        if ($this->product_is_there($order, $productId)){
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;

            if ($pivotRow->count < 2){
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
    }

    public function detach_from_order($productId){
        $order = $this->get_order();
        $order->products()->detach($productId);
    }

    public function add_to_order($productId){
        $order = $this->get_order();
        $this->adding_action($order, $productId);
        session()->flash('basket_add', 'Товар добавлен в корзину!');
    }

    public function add_to_order_postMethod($products){
        $order = $this->get_order();
        foreach ($products['products'] as $productId) {
            $this->adding_action($order, $productId);
        }
        session()->flash('basket_add', 'Товар добавлен в корзину!');
    }

    public function confirm_order($telephone){
        $order = $this->get_order();
        $success = $order->saveOrder($telephone);
        if ($success){
            session()->flash('success', 'Ваш заказ принят в обработку!');
        } else {
            session()->flash('error', 'Что-то пошло не так...');
        }
        session()->forget('orderId');
    }
}
