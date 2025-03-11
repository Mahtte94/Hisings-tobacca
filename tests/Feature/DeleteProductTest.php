<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_product()
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

        $product = Product::create([
            'name' => 'Product to delete',
            'description' => 'This product will be deleted',
            'price' => 50.00,
            'image' => 'images/test.jpg',
            'strength' => 3
        ]);

        $product->categories()->attach($category->id);

        $productId = $product->id;

        $response = $this
            ->actingAs($user)
            ->delete("/{$product->id}");

        $response->assertRedirect('/dashboard');

        $this->assertDatabaseMissing('products', [
            'id' => $productId
        ]);

        $this->assertDatabaseMissing('category_product', [
            'product_id' => $productId
        ]);
    }
}
