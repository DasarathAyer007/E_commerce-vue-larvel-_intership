<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PaymentService;
use Illuminate\Http\JsonResponse;



class PaymentContoller extends Controller
{
    protected $paymentService;
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function paymentIntent(Request $request): mixed
    {

        return $this->paymentService->createPaymentIntent($request->order_id);

    }
    public function paymentVerify(Request $request): JsonResponse
    {

        return $this->paymentService->paymentVerify($request);
    }
    public function webHook(Request $request): JsonResponse
    {

        return $this->paymentService->webHook($request);
    }
}
