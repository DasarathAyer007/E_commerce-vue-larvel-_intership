<?php

namespace App\Http\Repositories;
use App\Http\Repositories\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository implements OrderRepositoryInterface
{

    public function getUserOrders(int $userId): Collection
    {
        return Order::with('orderItems.product', 'shippingAddress', 'user')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')->get();
    }

    public function getAllOrders(): Collection
    {
        return Order::with('orderItems.product', 'shippingAddress', 'user')
            ->orderBy('created_at', 'desc')->get();
    }
    public function getOrderById(int $id): ?Order
    {

        return Order::with('orderItems.product', 'shippingAddress', 'user')->where('id', $id)->first();
    }
    public function create(array $orderData, array $orderItems, array $shippingInfo): Order
    {
        $order = Order::create($orderData);

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
    public function updateStatus(int $id, string $status): ?Order
    {
        $order = Order::find($id);
        $order->status = $status;
        $order->save();
        return $order;
    }
    public function updatePaymentStatus(int $id, string $status): Order
    {
        $order = Order::find($id);
        $order->payment_status = $status;
        $order->save();
        return $order;
    }


    public function update($id, array $data)
    {

    }
    public function delete($id)
    {

    }

    public function countOrder(): int
    {
        return Order::count();
    }
    public function countOrderItem(): int
    {
        return OrderItem::count();
    }
    public function sumTotalAmount(): float
    {
        return Order::sum('total_price');
    }

}
