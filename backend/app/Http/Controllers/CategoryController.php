<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllParentCategories();

        return CategoryResource::collection($categories);
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->only([
            'name',
            'parent_id',
        ]);

        $category = $this->categoryService->createCategory($data);
        
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $deleted = $this->categoryService->forceDeleteCategory($category);

        return new CategoryResource($deleted);
    }
}
