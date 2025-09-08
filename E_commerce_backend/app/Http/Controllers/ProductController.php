<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Services\ProductService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $filters = [
            'category' => $request->query('category'),
            'search' => $request->query('search')
            // 'sort'     => $request->query('sort') ?? 'name',
            // 'order'    => $request->query('order') ?? 'asc',
        ];

        return ProductResource::collection($this->productService->getAllProducts($filters));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request): ProductResource
    {
        $product = $this->productService->createProduct($request->validated());
        return $product->toResource();
    }
    /**
     * Display the specified resource.
     */
    public function show(int $id): ProductResource
    {
        $product = $this->productService->getProductbyId($id);
        return $product->toResource();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, int $id): ProductResource
    {
        $product = $this->productService->updateProduct($id, $request->validated());
        return $product->toResource();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id): JsonResponse
    {
        if ($this->productService->deleteProduct((int) $id)) {
            return response()->json(['message' => 'Product deleted successfully']);
        }
        return response()->json(['message' => 'Failed to delete product'], 400);

    }
}
