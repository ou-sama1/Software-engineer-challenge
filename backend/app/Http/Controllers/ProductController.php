<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
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

        return response()->json($products, 200);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->only([
            'name',
            'description',
            'price',
            'image'
        ]);

        $product = $this->productService->createProduct($data);
        
        return response()->json($product, 201);
    }

    public function destroy(Product $product)
    {
        $deleted = $this->productService->forceDeleteProduct($product);

        return response()->json($product, 200);
    }
}
