<?php
namespace App\Http\Services;

use App\Http\Repositories\OrderRepository;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;


class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    public function getOrder($user)
    {

        if (Gate::allows('isAdmin')) {
            return $this->orderRepository->getAllOrders();
        } else {
            return $this->orderRepository->getUserOrders($user->id);

        }

    }
    public function createOrder(array $data, $user): Order
    {

        $orderItems = $data['orderItems'];
        $shippingInfo = $data['shippingInfo'];
        $totalPrice = 0;

        foreach ($orderItems as &$item) {
            $product = Product::findOrFail($item['product_id']);

            if ($product->quantity < $item['quantity']) {
                abort(400, "Insufficient stock for {$product->name}");
            }

            $item['price'] = $product->price;
            $totalPrice += $product->price * $item['quantity'];
        }

        $orderData = [
            "total_price" => $totalPrice,
            'user_id' => $user->id
        ];

        return $this->orderRepository->create($orderData, $orderItems, $shippingInfo);

    }
    public function getOrderById($id): ?Order
    {
        return $this->orderRepository->getOrderById($id);
    }
    public function updateOrder(Request $request, int $id): ?Order
    {
        $order = null;
        if (!empty($request->status)) {
            $order = $this->orderRepository->updateStatus($id, $request->status);
        }
        return $order;

    }
    public function deleteOrder()
    {

    }
    public function getTotalOrders(): int
    {
        return $this->orderRepository->countOrder();
    }

    public function getTotalOrderItem(): int
    {
        return $this->orderRepository->countOrderItem();
    }

    public function getTotalSoldAmount(): float
    {
        return $this->orderRepository->sumTotalAmount();
    }


}