<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_product()
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

        Storage::fake('public');

        $file = UploadedFile::fake()->image('product.jpg');

        $response = $this
            ->actingAs($user)
            ->post('/store', [
                'name' => 'Product name',
                'description' => 'Product description',
                'price' => 50.00,
                'image' => $file,
                'strength' => 3,
                'categories' => [$category->id]
            ]);

        $response->assertRedirect('/dashboard');

        $this->assertDatabaseHas('products', [
            'name' => 'Product name',
            'description' => 'Product description',
            'price' => 50.00,
            'strength' => 3
        ]);
    }
}
