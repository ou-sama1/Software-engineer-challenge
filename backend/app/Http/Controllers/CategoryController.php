<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
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
        $categories = $this->categoryService->getAllCategories();

        return response()->json($categories, 200);
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->only([
            'name',
            'parent_id',
        ]);

        $category = $this->categoryService->createCategory($data);
        
        return response()->json($category, 201);
    }

    public function destroy(Category $category)
    {
        $deleted = $this->categoryService->forceDeleteCategory($category);

        return response()->json($category, 200);
    }
}
