<x-app-layout>
    <div class="max-w-3xl m-auto p-6 bg-gray-700 rounded-lg shadow-md mt-16">
        <h1 class="text-2xl font-bold mb-6 text-white">Edit Product</h1>

        <!-- Display Errors -->
        @if ($errors->any())
        <ul class="w-1/2 mb-4 p-4 bg-red-100 text-red-600 rounded-lg">
            @foreach ($errors->all() as $error)
            <li class="list-disc ml-4">{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form method="POST" action="{{ route('update', $product) }}" enctype="multipart/form-data" class="space-y-4">
            @method('PATCH')
            @csrf



            <!-- Display Existing Image -->
            @if($product->image)
            <div class="mt-4">
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="text-white w-64 h-64 object-contain rounded-lg">
            </div>
            @endif

            <!-- Item Name -->
            <div>
                <label for="name" class="text-white block font-semibold mb-1">Product Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ $product->name }}"
                    class="w-1/2 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="text-white block font-semibold mb-1">Upload Image</label>
                <input
                    type="file"
                    name="image"
                    id="image"
                    class="text-white w-1/3 p-2 border border-gray-300 rounded-lg">
            </div>


            <!-- Description -->
            <div>
                <label for="description" class="text-white block font-semibold mb-1">Description</label>
                <textarea
                    name="description"
                    id="description"
                    class="w-2/3 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 resize-none h-32">{{ $product->description }}</textarea>
            </div>


            <!-- Price -->
            <div>
                <label for="price" class="text-white block font-semibold mb-1">Price</label>
                <input
                    type="text"
                    name="price"
                    id="price"
                    value="{{ $product->price }}"
                    class="w-1/5 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
            </div>

            <!-- Strength -->
            <div>
                <label for="strength" class="text-white block font-semibold mb-1">Pick the strength</label>
                <input type="number" name="strength" id="strength" min="1" max="6" value="{{ old('strength', $product->strength)}}">
            </div>

            <div>
                <label for="categories" class="text-white block font-semibold mb-1">Categories</label>
                <select
                    name="categories[]"
                    id="categories"
                    multiple
                    class="w-2/3 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
                    @foreach(\App\Models\Category::all() as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ $product->categories->contains($category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-300 mt-1">Hold Ctrl (or Cmd) to select multiple categories</p>
            </div>
            <!-- Submit Button -->
            <button
                type="submit"
                class="w-1/5 bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600">
                Edit Product
            </button>
        </form>
    </div>
</x-app-layout>