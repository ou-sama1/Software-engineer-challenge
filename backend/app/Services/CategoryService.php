<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CategoryService
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getAllParentCategories(): Collection
    {
        return $this->categoryRepo->getParents();
    }
    
    public function getAllCategories(): Collection
    {
        return $this->categoryRepo->getAll();
    }
    
    public function getOneCategory(int $categoryId): ?Category
    {
        return $this->categoryRepo->getOne($categoryId);
    }
    
    public function createCategory(array $data): Category
    {
        return $this->categoryRepo->create($data);
    }
    
    public function forceDeleteCategory(Model $category): bool
    {
        return $this->categoryRepo->forceDelete($category);
    }
}
