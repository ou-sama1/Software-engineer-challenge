<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $filters = [
            'category_id' => $request->get('category_id', null),
        ];
        $sortBy = $request->get('sort_by', 'name');

        $products = $this->productService->getPaginatedProducts($filters, $sortBy);

        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->only([
            'name',
            'description',
            'price',
            'category_ids',
            'image'
        ]);

        $product = $this->productService->createProduct($data);
        
        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $deleted = $this->productService->forceDeleteProduct($product);

        return new ProductResource($deleted);
    }
}
