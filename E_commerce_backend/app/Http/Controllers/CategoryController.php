<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Services\CategoryService;

class CategoryController extends Controller
{

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection($this->categoryService->getAllCategory());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $category=$this->categoryService->createCategory($request);

        return $category->toResource();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category=$this->categoryService->getCategoryById($id);
        return $category->toResource();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category=$this->categoryService->updateCategory($id,$request);

        return response()->json([
            'message'=>'update sucessfully'
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $category=$this->categoryService->deleteCategory($id);
        return response()->json([
            "message"=>"Deleted Sucessfully"
        ]);
    }
}
