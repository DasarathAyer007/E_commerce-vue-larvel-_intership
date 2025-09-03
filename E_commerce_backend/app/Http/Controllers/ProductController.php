<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Services\ProductService;


class ProductController extends Controller
{

    protected $productService;
    
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return ProductResource::collection($this->productService->getAllProducts());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product=$this->productService->createProduct($request);

        return $product->toResource();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product=$this->productService->getProductbyId($id);
        return $product->toResource();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product=$this->productService->updateProduct($id,$request);
        return $product->toResource();
        // return response($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->productService->deleteProduct($id);
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
