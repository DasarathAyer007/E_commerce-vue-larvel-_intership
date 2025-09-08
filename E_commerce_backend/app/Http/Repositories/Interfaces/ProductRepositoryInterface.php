<?php

namespace App\Http\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getAll(array $filters);
    public function getById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function countProducts();
    public function countStock();
    public function stockPrice();
}