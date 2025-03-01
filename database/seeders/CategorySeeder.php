<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Fruits', 'parent_category_id' => null],
            ['name' => 'Apple', 'parent_category_id' => 1],
            ['name' => 'Banana', 'parent_category_id' => 1],
            ['name' => 'Furniture', 'parent_category_id' => null],
            ['name' => 'Chairs', 'parent_category_id' => 4],
            ['name' => 'Tables', 'parent_category_id' => 4],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
