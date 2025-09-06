<?php

namespace App\Http\Repositories;
use App\Http\Repositories\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll(array $filters)
    {
   
        $query = Product::query();

        if(!empty($filters['category'])){
            $query->where('category_id',$filters['category']);
        }

        if(!empty($filters['search'])){
            $search=$filters['search'];
            $query->where('name', 'like', "%{$search}%");
        }

        $query->orderBy('created_at', 'desc');


        return $query->paginate(18);
    }

    public function getById($id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }
        
        return Product::destroy($id);
    }

    public function countProducts(){
        return Product::count();

    }
    public function countStock(){
        return Product::sum('quantity');
    }
    public function stockPrice(){
        return Product::sum(DB::raw('quantity * price'));   
     }
}
