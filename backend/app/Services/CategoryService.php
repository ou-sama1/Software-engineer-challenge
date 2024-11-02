<?php

namespace App\Services;

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
    
    public function getOneCategory(int $categoryId): Collection
    {
        return $this->categoryRepo->getOne($categoryId);
    }
    
    public function createCategory(array $data): Collection
    {
        return $this->categoryRepo->create($data);
    }
    
    public function forceDeleteCategory(Model $category): Collection
    {
        return $this->categoryRepo->forceDelete($category);
    }
}
