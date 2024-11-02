<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

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

    public function getPaginatedProducts(array $filters, string $sortBy): LengthAwarePaginator
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
        return $this->productRepo->create($data);
    }
    
    public function forceDeleteProduct(Model $product): bool
    {
        return $this->productRepo->forceDelete($product);
    }

    public function saveImageFromURL(string $URL): string
    {
        $newPath = 'products/' . basename($URL);
        $imageContent = file_get_contents($URL);

        Storage::disk('public')->put($newPath, $imageContent);

        return 'storage/' . $newPath;
    }
}
