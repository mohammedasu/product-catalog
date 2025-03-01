<?php
namespace App\DAO\V1;

class CategoryDAO
{
    public $id;
    public $name;
    public $parent_category_id;
    public $children = [];

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->parent_category_id = $data['parent_category_id'] ?? null;
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
