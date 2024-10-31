<?php

namespace App\Console\Commands;

use App\Services\CategoryService;
use Illuminate\Console\Command;

class deleteCategoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete {category_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CategoryService $categoryService)
    {
        $category_id = $this->argument('category_id');

        $category = $categoryService->getOneCategory($category_id);

        if (empty($category)) {
            throw new \Exception('Invalid category_id.');
        }

        $categoryService->forceDeleteCategory($category);
        $this->info("Successfully deleted category with id $category_id.");
    }
}
