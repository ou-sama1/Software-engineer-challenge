<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getAllCategories()
    {
        return $this->categoryRepo->getAll();
    }
    
    public function createCategory($data)
    {
        return $this->categoryRepo->create($data);
    }
    
    public function forceDeleteCategory($category)
    {
        return $this->categoryRepo->forceDelete($category);
    }
}
