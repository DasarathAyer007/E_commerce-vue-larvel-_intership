<?php
namespace App\Http\Services;

use App\Http\Repositories\OrderRepository; 
use App\Models\Product;
use Illuminate\Support\Facades\Gate;



class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    public function getOrder($user){
        //check for admin change this later
        if(Gate::allows('isAdmin')){
            return $this->orderRepository->getAllOrders();
        }else{
            return $this->orderRepository->getUserOrders($user->id);

        }


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
    public function getOrderById($id){
        return $this->orderRepository->getOrderById($id);
    }
    public function updateOrder($request,$id){

        // return $request->status;
        $order=null;
         if(!empty($request->status)){
            $order= $this->orderRepository->updateStatus($id,$request->status);
        }
        return $order;

    }
    public function deleteOrder(){

    }
    public function getTotalOrders()
    {
        return $this->orderRepository->countOrder();
    }

    public function getTotalOrderItem()
    {
        return $this->orderRepository->countOrderItem();
    }

     public function getTotalSoldAmount()
    {
        return $this->orderRepository->sumTotalAmount();
    }


}