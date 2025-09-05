<?php

namespace App\Http\Repositories;
use App\Http\Repositories\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderRepository implements OrderRepositoryInterface
{

    public function getUserOrders($userId)
    {

        return Order::with('orderItems.product','shippingAddress')
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'desc')->get();
    }
    public function getAllOrders(){
        return Order::with('orderItems.product')
                    ->orderBy('created_at', 'desc')->get();
    }
    public function create($orderData,$orderItems,$shippingInfo){
        $order= Order::create($orderData);

        foreach ($orderItems as $item) {
        $order->orderItems()->create([
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
        }

        $order->shippingAddress()->create($shippingInfo);



        $product = Product::find($item['product_id']);
        $product->decrement('quantity', $item['quantity']);

        return $order->load('orderItems.product');

        

    }
    public function update($id, array $data){

    }
    public function delete($id){

    }
   
}
