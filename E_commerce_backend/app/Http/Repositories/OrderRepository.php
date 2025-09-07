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
        return Order::with('orderItems.product','shippingAddress','user')
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'desc')->get();
    }

    public function getAllOrders(){
        return Order::with('orderItems.product','shippingAddress','user')
                    ->orderBy('created_at', 'desc')->get();
    }
    public function getOrderById($id){

        return Order::with('orderItems.product','shippingAddress','user')->where('id', $id)->first();
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
    public function updateStatus($id , $status){
        $product=Order::find($id);
        $product->status=$status;
        $product->save();
        return $product;
    }
    public function updatePaymentStatus($id , $status){
        $product=Order::find($id);
        $product->payment_status=$status;
        $product->save();
        return $product;
    }


    public function update($id, array $data){

    }
    public function delete($id){

    }

    public function countOrder(){
        return Order::count();
    }
    public function countOrderItem(){
        return OrderItem::count();
    }
    public function sumTotalAmount(){
        return Order::sum('total_price');
    }   
   
}
