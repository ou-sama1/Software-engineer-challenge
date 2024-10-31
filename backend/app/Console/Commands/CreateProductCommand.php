<?php

namespace App\Console\Commands;

use App\Services\ProductService;
use Illuminate\Console\Command;

class CreateProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create {name} {description} {price} {category_ids?} {image?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ProductService $productService)
    {
        $name = $this->argument('name');
        $description = $this->argument('description');
        $price = $this->argument('price');
        $category_ids = $this->argument('category_ids') ?? null;
        $image = $this->argument('image') ?? null;

        $productService->createProduct([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_ids' => $category_ids,
            'image' => $image,
        ]);

        $this->info("Successfully created product $name.");
    }
}
