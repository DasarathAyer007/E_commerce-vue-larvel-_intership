<?php

namespace App\Http\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getAll(array $filters);
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function countProducts();
    public function countStock();
    public function stockPrice();
}