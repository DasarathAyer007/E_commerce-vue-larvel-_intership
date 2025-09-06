<?php

namespace App\Http\Controllers;
use App\Http\Services\OrderService;
use App\Http\Resources\OrderResource;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    function __construct(OrderService $orderService)
    {
         $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $user=auth()->user();
        $orders= $this->orderService->getOrder($user);
        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order=$this->orderService->createOrder($request ,$request->user());
        return response()->json($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->orderService->getOrderById($id)->toResource();
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $order=$this->orderService->updateOrder($request ,$id);
        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
