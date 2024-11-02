<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ProductService
{
    protected $productRepo;
    protected $categoryRepo;

    public function __construct(ProductRepository $productRepo, CategoryRepository $categoryRepo)
    {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function getOneProduct(int $productId): ?Product
    {
        return $this->productRepo->getOne($productId);
    }

    public function getPaginatedProducts(array $filters, string $sortBy): Collection
    {
        if (!empty($filters['category_id'])) {
            $categoryIds = $this->categoryRepo->getOneWithDescendants($filters['category_id']);

            if (!empty($categoryIds)) {
                $filters['category_id'] = $categoryIds;
            }
        }
        
        return $this->productRepo->getPaginated($filters, $sortBy);
    }
    
    public function createProduct(array $data): Product
    {
        if (isset($data['image'])) {
            $imagePath = $data['image']->store('products', 'public');
            $data['image'] = $imagePath;
        }

        return $this->productRepo->create($data);
    }
    
    public function forceDeleteProduct(Model $product): bool
    {
        return $this->productRepo->forceDelete($product);
    }
}
