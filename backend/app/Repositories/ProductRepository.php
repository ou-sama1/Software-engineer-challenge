<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository
{
    public function getPaginated($filters = [], $sort = 'name')
    {
        return Product::with('categories')
            ->when($filters['category'] ?? false, fn($query, $category) =>
                $query->whereHas('categories', fn($q) => $q->where('name', $category))
            )
            ->orderBy($sort)
            ->paginate(10);
    }
    
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $product = Product::create([
                'name' => data_get($attributes, 'name'),
                'description' => data_get($attributes, 'description'),
                'price' => data_get($attributes, 'price'),
                'image' => data_get($attributes, 'image_path'),
            ]);

            if (!empty(data_get($attributes, 'category_id'))) {
                $category = Category::find(data_get($attributes, 'category_id'));

                if ($category) {
                    $product->categories()->attach($category->id);
                }
            }

            return $product;
        });
    }

    public function forceDelete($product)
    {
        return DB::transaction(function () use ($product) {
            $deleted = $product->forceDelete();

            if (!$deleted) {
                throw new \Exception('Faild to delete this product.');
            }

            return $deleted;
        });
    }
}
