<?php

namespace App\Http\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function getUserOrders($userId);
    public function getAllOrders();
    public function getOrderById($id);
    public function create($orderData,$orderItems,$shippingInfo);
    public function updateStatus($id , $status);
    public function update($id, array $data);
    public function delete($id);
    public function countOrder();
    public function sumTotalAmount();
}