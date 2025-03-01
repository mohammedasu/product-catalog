<?php
namespace App\Services\V1;

use App\Repositories\V1\CategoryRepository;
use App\BO\V1\CategoryBO;
use App\Interfaces\V1\CategoryRepositoryInterface;

class CategoryService
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();

        return array_map(fn($category) => new CategoryBO($category), $categories);
    }
}
