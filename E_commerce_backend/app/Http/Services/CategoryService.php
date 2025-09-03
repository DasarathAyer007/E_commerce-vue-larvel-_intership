<?php
namespace App\Http\Services;

use App\Http\Repositories\CategoryRepository; 

class CategoryService
{
    protected $CategoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategory(){

        return $this->categoryRepository->getAll();
    }

    public function getCategoryById($id){
        return $this->categoryRepository->getById($id);
    }

    public function createCategory($request){
        $data=[
            'name'=>$request->name,
            'description'=>$request->description
        ];

        return $this->categoryRepository->create($data);

    }

    public function updateCategory($id,$request){
        $data=[
            'name'=>$request->name,
            'description'=>$request->description
        ];

        return $this->categoryRepository->update($id,$data);

    }

    public function deleteCategory($id){
        return $this->categoryRepository->delete($id);

    }
}