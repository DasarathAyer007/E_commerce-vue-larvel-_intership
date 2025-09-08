<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection($this->categoryService->getAllCategory());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): CategoryResource
    {
        $data = $request->only(['name', 'description']);
        $category = $this->categoryService->createCategory($data);

        return $category->toResource();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): CategoryResource
    {
        $category = $this->categoryService->getCategoryById($id);
        return $category->toResource();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->only(['name', 'description']);
        $category = $this->categoryService->updateCategory($id, $data);

        return response()->json([
            'message' => 'update sucessfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $category = $this->categoryService->deleteCategory($id);
        return response()->json([
            "message" => "Deleted Sucessfully"
        ]);
    }
}
