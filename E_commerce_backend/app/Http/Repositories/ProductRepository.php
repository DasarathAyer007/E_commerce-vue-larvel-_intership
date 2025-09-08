<?php

namespace App\Http\Repositories;
use App\Http\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProductRepository implements ProductRepositoryInterface
{
    public function getAll(array $filters): LengthAwarePaginator
    {

        $query = Product::query();

        if (!empty($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where('name', 'like', "%{$search}%");
        }

        $query->orderBy('created_at', 'desc');


        return $query->paginate(18);
    }

    public function getById(int $id): ?Product
    {
        return Product::findOrFail($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): Product
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete(int $id): bool
    {
        $product = Product::findOrFail($id);

        if ($product->image_path) {

            $publicId = pathinfo($product->image_path, PATHINFO_FILENAME);

            try {
                cloudinary()->uploadApi()->destroy($publicId);
            } catch (\Exception $e) {

                \Log::error("Failed to delete Cloudinary image: " . $e->getMessage());
            }
        }

        return Product::destroy($id) > 0;
    }

    public function countProducts(): int
    {
        return Product::count();

    }
    public function countStock(): int
    {
        return Product::sum('quantity');
    }
    public function stockPrice(): float
    {
        return Product::sum(DB::raw('quantity * price'));
    }
}
