<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            'White',
            'Black',
            'Powder',
            'Pouches'
        ];

        foreach ($categories as $categoryName) {
            Category::create(['name' => $categoryName]);
        }

        Category::factory()->count(5)->create();
    }
}