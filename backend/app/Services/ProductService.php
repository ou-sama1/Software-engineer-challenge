<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function getPaginatedProducts($filters, $sortBy)
    {
        if (!empty($filters['category_id'])) {
            $categoryRepo = new CategoryRepository();
            $categoryIds = $categoryRepo->getOneWithDescendants($filters['category_id']);

            if (!empty($categoryIds)) {
                $filters['category_id'] = $categoryIds;
            }
        }
        
        return $this->productRepo->getPaginated($filters, $sortBy);
    }
    
    public function createProduct($data)
    {
        if (isset($data['image'])) {
            $imagePath = $data['image']->store('products', 'public');
            $data['image'] = $imagePath;
        }

        return $this->productRepo->create($data);
    }
    
    public function forceDeleteProduct($product)
    {
        return $this->productRepo->forceDelete($product);
    }
}
