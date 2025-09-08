<?php
namespace App\Http\Services;

use App\Http\Repositories\PaymentRepository;
use App\Http\Repositories\OrderRepository;
use Illuminate\Support\Facades\Gate;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;
use Illuminate\Http\JsonResponse;


class PaymentService
{
    protected $paymentRepository;
    protected $orderRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->orderRepository = new OrderRepository();
    }

    public function createPaymentIntent($order_id)
    {

        $id = $order_id;
        $order = $this->orderRepository->getOrderById($id);


        Gate::authorize('pay-order', $order);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $order->total_price * 100,
            'currency' => 'usd',
            'metadata' => [
                'order_id' => $order->id,
                'user_id' => $order->user_id
            ],
        ]);

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
            'order' => $order
        ]);

    }
    public function paymentVerify($request): JsonResponse
    {

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntentId = $request->payment_intent_id;
        $orderId = $request->order_id;

        $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

        if ($paymentIntent->status === 'succeeded') {

            $order = $this->orderRepository->updatePaymentStatus($orderId, 'paid');

            $payment = $this->paymentRepository->create([
                'order_id' => $orderId,
                'user_id' => $paymentIntent->metadata->user_id,
                'stripe_payment_id' => $paymentIntent->id,
                'amount' => $paymentIntent->amount_received / 100,
                'currency' => $paymentIntent->currency,
                'status' => $paymentIntent->status,
            ]);


            return response()->json([$payment, 'success' => true]);
        }
        return response()->json([ 'success' => false],400);
    }

    public function webHook($request): JsonResponse
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = env('STRIPE_WEBHOOK_SECRET');


        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);

            if ($event->type === 'payment_intent.succeeded') {
                $paymentIntent = $event->data->object;
                Log::info('Payment succeeded: ' . $paymentIntent->id);

                // Update order in DB here
                $orderId = $paymentIntent->metadata->order_id ?? null;
                if ($orderId) {
                    $order = $this->orderRepository->updatePaymentStatus($orderId, 'paid');

                    $this->paymentRepository->create([
                        'order_id' => $orderId,
                        'user_id' => $paymentIntent->metadata->user_id,
                        'stripe_payment_id' => $paymentIntent->id /100,
                        'amount' => $paymentIntent->amount_received,
                        'currency' => $paymentIntent->currency,
                        'status' => $paymentIntent->status,
                    ]);

                }

            }

            return response()->json(['received' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}



