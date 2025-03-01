<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): JsonResponse
    {
        return response()->json(
            array_map(fn($category) => $category->toArray(), $this->categoryService->index())
        );
    }
}
