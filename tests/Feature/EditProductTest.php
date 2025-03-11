<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EditProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_edit_product()
    {
        $user = User::factory()->create([
            'name' => 'Toby',
            'email' => 'toby@ht.se',
            'password' => Hash::make('123'),
            'role' => 'admin'
        ]);

        $category = new Category();
        $category->name = 'Test Category';
        $category->save();

        $newCategory = new Category();
        $newCategory->name = 'New Test Category';
        $newCategory->save();

        Storage::fake('public');
        $file = UploadedFile::fake()->image('original.jpg');

        $product = Product::create([
            'name' => 'Original name',
            'description' => 'Original description',
            'price' => 50.00,
            'image' => $file->store('images', 'public'),
            'strength' => 3
        ]);

        $product->categories()->attach($category->id);

        $newFile = UploadedFile::fake()->image('updated.jpg');

        $response = $this
            ->actingAs($user)
            ->patch("/{$product->id}", [
                'name' => 'Updated name',
                'description' => 'Updated description',
                'price' => 55.00,
                'image' => $newFile,
                'strength' => 5,
                'categories' => [$newCategory->id]
            ]);

        $response->assertRedirect('/' . $product->id);
        $response->assertSessionHas('success', 'Product updated successfully');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated name',
            'description' => 'Updated description',
            'price' => 55.00,
            'strength' => 5
        ]);

        $updatedProduct = Product::find($product->id);
        $this->assertNotEquals($product->image, $updatedProduct->image);

        $this->assertDatabaseMissing('category_product', [
            'product_id' => $product->id,
            'category_id' => $category->id
        ]);

        $this->assertDatabaseHas('category_product', [
            'product_id' => $product->id,
            'category_id' => $newCategory->id
        ]);
    }

    public function test_edit_product_validation_failure()
    {
        $user = User::factory()->create([
            'role' => 'admin'
        ]);

        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 50.00,
            'image' => 'images/test.jpg',
            'strength' => 3
        ]);

        $response = $this
            ->actingAs($user)
            ->patch("/{$product->id}", [
                'name' => '',
                'description' => 'Updated Description',
                'price' => 55.00,
                'categories' => []
            ]);

        $response->assertSessionHasErrors(['name', 'categories']);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Test Product',
            'description' => 'Test Description'
        ]);
    }
}
