<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    protected $productService;
    protected $categoryService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productService = app(ProductService::class);
        $this->categoryService = app(CategoryService::class);

        $this->categoryService->createCategory(['name' => 'Test Category']);
    }

    /** @test */
    public function test_product_creation_with_category()
    {
        $category = Category::first();

        $data = [
            'name' => 'Test Product',
            'description' => 'A sample product for testing.',
            'price' => 49.99,
            'category_ids' => [$category->id],
        ];

        $product = $this->productService->createProduct($data);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals(49.99, $product->price);
        $this->assertTrue($product->categories->contains($category));
    }
    
    /** @test */
    public function test_product_creation_without_a_category()
    {
        $data = [
            'name' => 'Test Product',
            'description' => 'A sample product for testing.',
            'price' => 49.99
        ];

        $product = $this->productService->createProduct($data);
        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals(49.99, $product->price);
    }
    
    /** @test */
    public function test_ignore_invalid_category_ids()
    {
        $category = Category::first();
        $invalidCategoryId = $category->id + 1;

        $data = [
            'name' => 'Test Product',
            'description' => 'A sample product for testing.',
            'price' => 49.99,
            'category_ids' => [$invalidCategoryId],
        ];

        $product = $this->productService->createProduct($data);
        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals(49.99, $product->price);
        $this->assertFalse($product->categories->contains($category));
    }

    /** @test */
    public function test_product_creation_with_multiple_categories()
    {
        $this->categoryService->createCategory(['name' => 'Another Test Category']);
        $categoryIds = Category::pluck('id')->toArray();

        $data = [
            'name' => 'Multi-Category Product',
            'description' => 'A product belonging to multiple categories.',
            'price' => 75.00,
            'category_ids' => $categoryIds,
        ];

        $product = $this->productService->createProduct($data);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertCount(2, $product->categories);
    }
}
