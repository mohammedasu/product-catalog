<?php
namespace App\DAO\V1;

class ProductDAO
{
    public $id;
    public $name;
    public $description;
    public $sku;
    public $price;
    public $category_id;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->sku = $data['sku'] ?? '';
        $this->price = $data['price'] ?? 0.0;
        $this->category_id = $data['category_id'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'sku' => $this->sku,
            'price' => $this->price,
            'category_id' => $this->category_id,
        ];
    }
}
