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
   
    Storage::disk('public')->makeDirectory('images');

   
    Product::factory()
      ->count(30)
      ->create()
      ->each(function ($product) {
     
        $categories = Category::inRandomOrder()
          ->take(rand(1, 3))
          ->pluck('id');

        $product->categories()->attach($categories);
      });

  }
}
