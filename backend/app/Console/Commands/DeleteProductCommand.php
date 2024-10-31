<?php

namespace App\Console\Commands;

use App\Services\ProductService;
use Illuminate\Console\Command;

class DeleteProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete {product_id}';

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
        $product_id = $this->argument('product_id');

        $product = $productService->getOneProduct($product_id);

        if (empty($product)) {
            throw new \Exception('Invalid product_id.');
        }

        $productService->forceDeleteProduct($product);
        $this->info("Successfully deleted product with id $product_id.");
    }
}
