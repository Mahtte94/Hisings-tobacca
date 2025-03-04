<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $products = Product::paginate(4);;

        return view('index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveProductRequest $request)
    {
        $imagePath = $request->file('image')->store('images', 'public');

        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'strength' => $request->input('strength'),
            'type' => $request->input('type'),
            'price' => $request->input('price'),
            'image' => $imagePath,
        ]);


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

        $product = Product::findOrFail($id);

        return view('show', [
            'product' => $product
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
            'strength' => 'nullable|numeric',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->strength = $request->input('strength');
        $product->type = $request->input('type');
        $product->price = $request->input('price');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Store new image in the 'products' folder inside 'public/storage'
            $path = $request->file('image')->store('images', 'public');

            // Ensure database stores the relative path
            $product->image = $path;
        }

        $product->save();

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
}
