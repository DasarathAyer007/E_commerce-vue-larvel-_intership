<?php
namespace App\Http\Services;

use App\Http\Repositories\ProductRepository; 
use Illuminate\Support\Facades\Storage;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    public function getProductbyId($id)
    {
        return $this->productRepository->getById($id);
    }
    public function createProduct($request)
    {
        
        $path = $request->file('image')->store('products', 'public');
        $data=[
            'name'=>$request->name,
            'description'=>$request->description,
            'image_path'=>$path,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'category_id'=>$request->category,
            'user_id'=>$request->user()->id
        ];
  
        return $this->productRepository->create($data);
    }

    public function updateProduct($id,$request)
    {
        $product= $this->productRepository->getById($id);
        $data=[
            'name'=>$request->name,
            'description'=>$request->description,
            'image_path'=>$product->image_path,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'category_id'=>$request->category,
        ];
     

        if($request->hasfile('image')){
            if($product->image_path && Storage::disk('public')->exists($product->image_path)){
                Storage::disk('public')->delete($product->image_path);
                $path = $request->file('image')->store('products', 'public');
                $data['image_path'] = $path;
            }
        }
        // return response($data);

        return $this->productRepository->update($id, $data);
    }
    
    
    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }
}
