<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'parent_id' => null],
            ['name' => 'Laptops', 'parent_id' => 1],
            ['name' => 'Smartphones', 'parent_id' => 1],
            ['name' => 'Gaming Consoles', 'parent_id' => 1],
            ['name' => 'Accessories', 'parent_id' => null],
            ['name' => 'Chargers', 'parent_id' => 5],
            ['name' => 'Headphones', 'parent_id' => 5],
            ['name' => 'Home Appliances', 'parent_id' => null],
            ['name' => 'Kitchen', 'parent_id' => 8],
            ['name' => 'Furniture', 'parent_id' => null],
            ['name' => 'Chairs', 'parent_id' => 10],
            ['name' => 'Tables', 'parent_id' => 10],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
