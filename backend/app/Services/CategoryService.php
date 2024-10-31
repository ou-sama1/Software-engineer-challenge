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

    public function getAllParentCategories()
    {
        return $this->categoryRepo->getParents();
    }
    
    public function getAllCategories()
    {
        return $this->categoryRepo->getAll();
    }
    
    public function getOneCategory($categoryId)
    {
        return $this->categoryRepo->getOne($categoryId);
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
