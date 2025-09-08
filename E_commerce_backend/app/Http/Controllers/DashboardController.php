<?php

namespace App\Http\Controllers;

use App\Http\Services\OrderService;
use App\Http\Services\UserService;
use App\Http\Services\ProductService;
use Illuminate\Http\JsonResponse;



class DashboardController extends Controller
{
    protected $orderService;
    protected $userService;
    protected $productService;

    public function __construct(
        OrderService $orderService,
        UserService $userService,
        ProductService $productService
    ) {
        $this->orderService = $orderService;
        $this->userService = $userService;
        $this->productService = $productService;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'totalOrders' => $this->orderService->getTotalOrders(),
            'totalSoldamount' => $this->orderService->getTotalSoldAmount(),
            'totalOrderItem' => $this->orderService->getTotalOrderItem(),

            'totalUsers' => $this->userService->getTotalUser(),

            'totalProducts' => $this->productService->getTotalProducts(),
            'productsInStock' => $this->productService->getTotalStock(),
            'stockworth' => $this->productService->getStockworth()
        ]);
    }
}
