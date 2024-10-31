<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function run(): void
    {
        $this->call(CategorySeeder::class);

        $categories = $this->categoryService->getAllCategories();
        Product::factory(20)->create()->each(function ($product) use ($categories) {
            $product->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
