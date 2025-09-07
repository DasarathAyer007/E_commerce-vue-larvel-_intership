<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Webhook;
use App\Models\Order;
use App\Http\Services\PaymentService;


class PaymentContoller extends Controller
{
    protected $paymentService;
    function __construct(PaymentService $paymentService)
    {
         $this->paymentService = $paymentService;
    }
    public function paymentIntent(Request $request){

         return $this->paymentService->createPaymentIntent($request);

        // $id=$request->order_id;
        // $order=Order::find($id);

        // Stripe::setApiKey(env('STRIPE_SECRET'));
        // $paymentIntent = PaymentIntent::create([
        //     'amount' => $order->total_price, 
        //     'currency' => 'usd',
        //     'metadata' => [
        //         'order_id' => $order->id,
        //     ],
        
        // ]);

        // return response()->json([
        //     'clientSecret' => $paymentIntent->client_secret,
        //     'order' => $order
        // ]);
                
    }
    public function paymentVerify(Request $request){

           return $this->paymentService->paymentVerify($request);
    }
    public function webHook(Request $request){

            return $this->paymentService->webHook($request);
    }
}
