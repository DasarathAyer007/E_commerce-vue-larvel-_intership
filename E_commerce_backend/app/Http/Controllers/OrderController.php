<?php

namespace App\Http\Controllers;
use App\Http\Services\OrderService;
use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $user = auth()->user();
        $orders = $this->orderService->getOrder($user);
        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderStoreRequest $request): JsonResponse
    {
        $order = $this->orderService->createOrder($request->validated(), $request->user());
        return response()->json($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): OrderResource
    {
        return $this->orderService->getOrderById($id)->toResource();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $order = $this->orderService->updateOrder($request, $id);
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
