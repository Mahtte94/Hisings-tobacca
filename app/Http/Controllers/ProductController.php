<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'asc');

        $allowedSorts = ['id', 'name', 'price', 'strength'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        $products = DB::table('products')
            ->orderBy($sort, $direction)
            ->paginate(4);

        return view('index', [
            'products' => $products,
            'sort' => $sort,
            'direction' => $direction
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action');
        }

        $product = new Product();
        return view('create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveProductRequest $request)
    {
        $imagePath = $request->file('image')->store('images', 'public');

        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image' => $imagePath,
            'strength' => $request->input('strength')
        ]);

        // Attach categories if present
        if ($request->has('categories')) {
            $product->categories()->attach($request->input('categories'));
        }

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */

    public function search(Request $request)
    {

        $query = $request->input('query');

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($products);
    }

    public function show(string $id)
    {

        $products = Product::findOrFail($id);

        return view('show', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $product->image = $path;
        }

        $product->save();

        // Sync categories if present
        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }

        return redirect()->route('show', $id)->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        $product->delete();

        return redirect()->route('dashboard');
    }

    public function showByCategory($name)
    {
        $category = Category::where('name', $name)->firstOrFail();
        $products = $category->products()->paginate(15);

        return view('category', [
            'category' => $category,
            'products' => $products
        ]);
    }
}
