<?php
namespace App\Repositories\V1;

use App\Models\Category;
use App\DAO\V1\CategoryDAO;
use App\Interfaces\V1\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll()
    {
        return Cache::remember('categories_nested', 3600, function () {
            $categories = Category::all()->toArray();

            return $this->childCategory($categories);
        });
    }

    private function childCategory(array $categories, $parentId = null)
    {
        $tree = [];

        foreach ($categories as $category) {
            if ($category['parent_category_id'] == $parentId) {
                $categoryDAO = new CategoryDAO($category);
                $categoryDAO->children = $this->childCategory($categories, $category['id']);
                $tree[] = $categoryDAO;
            }
        }

        return $tree;
    }
}
