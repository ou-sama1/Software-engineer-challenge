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

    public function getPaginatedProducts()
    {
        return $this->productRepo->getPaginated();
    }
    
    public function createProduct($data)
    {
        return $this->productRepo->create($data);
    }
    
    public function forceDeleteProduct($product)
    {
        return $this->productRepo->forceDelete($product);
    }
}
