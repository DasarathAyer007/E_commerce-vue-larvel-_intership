<?php

namespace App\Http\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function getUserOrders(int $userId);
    public function getAllOrders();
    public function getOrderById(int $id);
    public function create(array $orderData,array $orderItems,array $shippingInfo);
    public function updateStatus(int $id , string $status);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function countOrder();
    public function sumTotalAmount();
}