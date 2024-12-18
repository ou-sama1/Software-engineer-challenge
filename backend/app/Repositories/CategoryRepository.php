<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository
{
    public function getParents(): Collection
    {
        $categories = Category::where('parent_id', null)->with('children')->get();

        return $categories;
    }
    
    public function getAll(): Collection
    {
        $categories = Category::all();

        return $categories;
    }

    public function getOne(int $categoryId): ?Category
    {
        $category = Category::with('children')->find($categoryId);

        return $category;
    }
    
    public function getOneWithDescendants(int $categoryId): array
    {
        $category = Category::with('children')->find($categoryId);

        return $this->collectDescendantIds($category, [$category->id]);
    }

    private function collectDescendantIds(Category $category, array $ids = []): array
    {
        foreach ($category->children as $child) {
            $ids[] = $child->id;
            $ids = $this->collectDescendantIds($child, $ids);
        }

        return $ids;
    }

    public function create(array $attributes): Category
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

    public function forceDelete(Model $category): bool
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
