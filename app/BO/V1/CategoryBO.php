<?php
namespace App\BO\V1;

use App\DAO\V1\CategoryDAO;

class CategoryBO
{
    public $id;
    public $name;
    public $parent_category_id;
    public $children = [];

    public function __construct(CategoryDAO $categoryDAO)
    {
        $this->id = $categoryDAO->id;
        $this->name = $categoryDAO->name;
        $this->parent_category_id = $categoryDAO->parent_category_id;
        $this->children = array_map(fn($child) => new CategoryBO($child), $categoryDAO->children);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'parent_category_id' => $this->parent_category_id,
            'children' => array_map(fn($child) => $child->toArray(), $this->children),
        ];
    }
}
