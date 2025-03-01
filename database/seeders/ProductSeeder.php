<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fruits = Category::where('name', 'Fruits')->first();
        $furniture = Category::where('name', 'Furniture')->first();

        $products = [
            ['name' => 'Kashmiri Apple', 'description' => 'Kashmir', 'sku' => 'MBP2024', 'price' => 2500, 'category_id' => $fruits->id ?? null],
            ['name' => 'Kerala Banana', 'description' => 'Kerala', 'sku' => 'IPH15', 'price' => 1200, 'category_id' => $fruits->id ?? null],
            ['name' => 'Office Chair', 'description' => 'Ergonomic chair', 'sku' => 'OCH123', 'price' => 150, 'category_id' => $furniture->id ?? null],
            ['name' => 'Dining Table', 'description' => 'Wooden table', 'sku' => 'DNTABLE', 'price' => 300, 'category_id' => $furniture->id ?? null],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
