<?php

namespace App\Services;

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
