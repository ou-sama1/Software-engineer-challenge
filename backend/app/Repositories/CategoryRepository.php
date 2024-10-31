<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository
{
    public function getAll()
    {
        return Category::all();
    }

    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            if (!empty(data_get($attributes, 'parent_id'))) {
                $parentCategory = Category::find(data_get($attributes, 'parent_id'));

                if (!$parentCategory) {
                    throw new \Exception('Invalid parent_id.');
                }
            }

            $category = Category::create([
                'name' => data_get($attributes, 'name'),
                'parent_id' => data_get($attributes, 'parent_id', null),
            ]);

            return $category;
        });
    }

    public function forceDelete($category)
    {
        return DB::transaction(function () use ($category) {
            $deleted = $category->forceDelete();

            if (!$deleted) {
                throw new \Exception('Faild to delete this category.');
            }

            return $deleted;
        });
    }
}
