<?php
namespace App\Http\Services;

use App\Http\Repositories\OrderRepository; 
use App\Models\Product;


class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    public function getOrder($user){
        //check for admin change this later
        if($user->role_id==2){
            return $this->orderRepository->getAllOrders();
        }

        return $this->orderRepository->getUserOrders($user->id);

    }
    public function createOrder($request,$user){

        $orderIteams=[];
        $totalPrice=0;

        foreach($request->orderItems as $iteam){
             $product = Product::findOrFail($iteam['product_id']);
             if($product->quantity<$iteam['quantity']){
                  abort(400, 'Insufficient stock for ' . $product->name);
             }
            $orderItems[]=[
                'product_id'=>$product->id,
                'quantity'=>$iteam['quantity'],
                'price'=>$product->price
            ];
            $totalPrice+=($product->price)*$iteam['quantity'];
        }

        $shippingInfo=[
            'phone'=>$request->shippingInfo['phone'],
            'address'=>$request->shippingInfo['address'],
            'city'=>$request->shippingInfo['city'],
            'postal_code'=>$request->shippingInfo['postal_code']
            
        ];

    

        $orderData=[
            "total_price"=>$totalPrice,
            'user_id'=>$user->id
        ];

        return $this->orderRepository->create($orderData,$orderItems,$shippingInfo);


    }
    public function getOrderById(){

    }
    public function updateOrder(){

    }
    public function deleteOrder(){

    }


}