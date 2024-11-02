<?php

namespace App\Console\Commands;

use App\Services\CategoryService;
use Illuminate\Console\Command;

class CreateCategoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create {name} {parent_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new category';

    /**
     * Execute the console command.
     */
    public function handle(CategoryService $categoryService): void
    {
        $name = $this->argument('name');
        $parent_id = $this->argument('parent_id') ?? null;

        if ($parent_id !== null) {
            $category = $categoryService->getOneCategory($parent_id);

            if (empty($category)) {
                throw new \Exception('Invalid parent_id.');
            }
        }
        
        $categoryService->createCategory([
            'name' => $name,
            'parent_id' => $parent_id
        ]);
        
        $this->info("Successfully created category $name.");
    }
}
