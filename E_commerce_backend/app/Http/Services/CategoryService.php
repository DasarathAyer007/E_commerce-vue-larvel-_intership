<?php
namespace App\Http\Services;

use App\Http\Repositories\CategoryRepository;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;


class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategory(): Collection
    {

        return $this->categoryRepository->getAll();
    }

    public function getCategoryById(int $id): Category
    {
        return $this->categoryRepository->getById($id);
    }

    public function createCategory(array $data): Category
    {

        return $this->categoryRepository->create($data);

    }

    public function updateCategory(int $id,array $data): Category
    {

        return $this->categoryRepository->update( $id, $data);

    }

    public function deleteCategory(int $id){
        return $this->categoryRepository->delete($id);

    }
}