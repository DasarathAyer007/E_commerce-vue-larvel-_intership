<?php
namespace App\Http\Services;

use App\Http\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;



class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(array $filters): LengthAwarePaginator
    {
        return $this->productRepository->getAll($filters);
    }

    public function getProductbyId(int $id)
    {
        return $this->productRepository->getById($id);
    }
    public function createProduct(array $data): product
    {
        //$imageUrl = $request->file('image')->store('products', 'public');

        if (isset($data['image'])) {
            $uploadedImage = cloudinary()->uploadApi()->upload($data['image']->getRealPath());
            $data['image_path'] = $uploadedImage['secure_url'];
            unset($data['image']);
        }
        $data['user_id'] = auth()->id();

        // $data=[
        //     'name'=>$request->name,
        //     'description'=>$request->description,
        //     'image_path'=>$imageUrl,
        //     'quantity'=>$request->quantity,
        //     'price'=>$request->price,
        //     'category_id'=>$request->category,
        //     'user_id'=>$request->user()->id
        // ];

        return $this->productRepository->create($data);
    }

    public function updateProduct(int $id, array $data): Product
    {
        // $product= $this->productRepository->getById($id);
        // $data=[
        //     'name'=>$request->name,
        //     'description'=>$request->description,
        //     'image_path'=>$product->image_path,
        //     'quantity'=>$request->quantity,
        //     'price'=>$request->price,
        //     'category_id'=>$request->category,
        // ];


        // if($request->hasfile('image')){
        //     if($product->image_path && Storage::disk('public')->exists($product->image_path)){
        //         Storage::disk('public')->delete($product->image_path);
        //         $path = $request->file('image')->store('products', 'public');
        //         $data['image_path'] = $path;
        //     }
        // }

        // return $this->productRepository->update($id, $data);
        //      if (isset($data['image'])) {

        //     $uploadedImage = cloudinary()->uploadApi()->upload($data['image']->getRealPath());
        //     $data['image_path'] = $uploadedImage['secure_url'];
        //     unset($data['image']); 
        // }



        $product = $this->productRepository->getById($id);



        if (isset($data['image'])) {
            if ($product->image_path) {
                $publicId = pathinfo($product->image_path, PATHINFO_FILENAME);
                try {
                    cloudinary()->uploadApi()->destroy($publicId);
                } catch (\Exception $e) {
                    \Log::error("Failed to delete old Cloudinary image: " . $e->getMessage());
                }
            }

            $uploadedImage = cloudinary()->uploadApi()->upload($data['image']->getRealPath());
            $data['image_path'] = $uploadedImage['secure_url'];
            unset($data['image']);
        } else {
            $data['image_path'] = $product->image_path;
        }

        $data['image_path'] = $data['image_path'] ?? $product->image_path;


        return $this->productRepository->update($id, $data);
    }


    public function deleteProduct(int $id): bool
    {
        return $this->productRepository->delete($id);
    }

    public function getTotalStock(): int
    {
        return $this->productRepository->countStock();
    }

    public function getTotalProducts(): int
    {
        return $this->productRepository->countProducts();
    }
    public function getStockworth(): float
    {
        return $this->productRepository->stockPrice();
    }

}
