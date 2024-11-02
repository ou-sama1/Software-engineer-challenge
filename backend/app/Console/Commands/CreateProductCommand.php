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
    protected $signature = 'product:create {name} {description} {price} {--image_url=} {--category_ids=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new product';

    /**
     * Execute the console command.
     */
    public function handle(ProductService $productService): void
    {
        $idsToArray = explode(' ', $this->option('category_ids'));

        $name = $this->argument('name');
        $description = $this->argument('description');
        $price = $this->argument('price');
        $category_ids = $idsToArray ?? [];
        $imageURL = $this->option('image_url') ?? null;

        if ($imageURL) {
            $imageURL = $productService->saveImageFromURL($imageURL);
        }

        $productService->createProduct([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_ids' => $category_ids,
            'image' => $imageURL,
        ]);

        $this->info("Successfully created product $name.");
    }
}
