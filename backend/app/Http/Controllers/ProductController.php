<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request): ResourceCollection
    {
        $filters = [
            'category_id' => $request['category_id'] ?? null,
        ];
        $sortBy = $request['sort_by'] ?? "name";
        $products = $this->productService->getPaginatedProducts($filters, $sortBy);

        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request): ProductResource
    {

        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'category_ids' => $request['category_ids'],
            'image' => $request['image'],
        ];

        if ($request['image']) {
            $imagePath = 'storage/' . $request['image']->store('products', 'public');
            $data['image'] = $imagePath;
        }

        $product = $this->productService->createProduct($data);
        
        return new ProductResource($product);
    }

    public function destroy(Product $product): ProductResource
    {
        $deleted = $this->productService->forceDeleteProduct($product);

        return new ProductResource($deleted);
    }
}
