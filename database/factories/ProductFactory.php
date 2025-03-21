<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Product::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {

    $imagePath = public_path('storage/test_resources/');

    
    if (!file_exists($imagePath)) {
      $randomImage = null;
    } else {
      $files = glob($imagePath . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
      $randomImage = count($files) > 0 ? basename($files[array_rand($files)]) : null;
    }

   
    $randomImage = count($files) > 0 ? basename($files[array_rand($files)]) : null;

    return [
      'name' => Str::limit($this->faker->words(2, true, 15)),
      'description' => $this->faker->paragraph(3),
      'price' => $this->faker->numberBetween(30, 50),
      'image' => $randomImage ? "test_resources/$randomImage" : null,
      'strength' => $this->faker->numberBetween(1, 6),
      'created_at' => now(),
      'updated_at' => now(),
    ];
  }
}
