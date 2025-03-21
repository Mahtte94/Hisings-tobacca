<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Ensure the storage directory exists
    Storage::disk('public')->makeDirectory('images');

    // Create products and attach random categories
    Product::factory()
      ->count(30)
      ->create()
      ->each(function ($product) {
        // Get random categories (between 1 and 3)
        $categories = Category::inRandomOrder()
          ->take(rand(1, 3))
          ->pluck('id');

        // Attach categories to product
        $product->categories()->attach($categories);
      });

  }
}
