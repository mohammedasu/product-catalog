<?php

namespace App\BO\V1;

use App\DAO\V1\ProductDAO;

class ProductBO
{
    // public function __construct(
    //     public readonly ?int $id,
    //     public readonly string $name,
    //     public readonly string $description,
    //     public readonly float $price,
    //     public readonly int $category_id
    // ) {}

    public ?int $id;
    public string $name; 
    public string $description;
    public string $sku;
    public float $price;
    public int $category_id;
    // public $id, $name, $description, $sku, $price, $category_id;
    public function __construct(ProductDAO $data)
    {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->description = $data->description;
        $this->sku = $data->sku;
        $this->price = $data->price;
        $this->category_id = $data->category_id;
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


