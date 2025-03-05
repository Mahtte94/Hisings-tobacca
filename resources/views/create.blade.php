<x-app-layout>
  <div class="max-w-3xl mx-auto p-6 bg-gray-700 rounded-lg shadow-md mt-16">
      <h1 class="text-2xl text-white font-bold mb-6">New Product</h1>

      <!-- Display Errors -->
      @if ($errors->any())
          <ul class="w-1/2 mb-4 p-4 bg-red-100 text-red-600 rounded-lg">
              @foreach ($errors->all() as $error)
                  <li class="list-disc ml-4">{{ $error }}</li>
              @endforeach
          </ul>
      @endif

      <!-- Product Form -->
      <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data" class="space-y-4">
          @csrf

          <!-- Image Preview -->
          <div class="mt-2">
            <img 
                id="imagePreview" 
                src="" 
                alt="Image Preview" 
                class="hidden w-48 h-48 object-contain rounded-lg"
            >
        </div>


          <!-- Image Upload -->
          <div>
              <label for="image" class="text-white block font-semibold mb-1">Upload Image</label>
              <input 
                  type="file" 
                  name="image" 
                  id="imageInput" 
                  class="text-white w-1/3 p-2 border border-gray-300 rounded-lg"
              >
          </div>

          <!-- Item Name -->
          <div>
            <label for="name" class="text-white block font-semibold mb-1">Product Name</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name') }}" 
                class="w-1/2 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200"
            >
        </div>

          <!-- Description -->
          <div>
              <label for="description" class="text-white block font-semibold mb-1">Description</label>
              <textarea 
                  name="description" 
                  id="description" 
                  class="w-2/3 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 resize-none h-32"
              >{{ old('description') }}</textarea>
          </div>

          <!-- Price -->
          <div>
              <label for="price" class="text-white block font-semibold mb-1">Price</label>
              <input 
                  type="text" 
                  name="price" 
                  id="price" 
                  value="{{ old('price') }}" 
                  class="w-1/5 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200"
              >
          </div>

           <!-- Strength -->
          <div>
            <label for="strength">Pick the strength</label>
            <input type="number" name="strength" id="strength" min="1" max="6" value="{{ old('strength', $product->strength)}}">
          </div>
          <!-- Categories -->
            <div>
                <label for="categories" class="text-white block font-semibold mb-1">Categories</label>
                <select 
                    name="categories[]" 
                    id="categories" 
                    multiple 
                    class="w-2/3 p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200"
                >
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-300 mt-1">Hold Ctrl (or Cmd) to select multiple categories</p>
            </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-1/4 bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600"
                    >
                        Create Product
                    </button>
                </form>
            </div>

  <script>
      document.getElementById('imageInput').addEventListener('change', function(event) {
          const file = event.target.files[0];
          if (file) {
              const reader = new FileReader();
              reader.onload = function(e) {
                  const preview = document.getElementById('imagePreview');
                  preview.src = e.target.result;
                  preview.style.display = 'block';
              };
              reader.readAsDataURL(file);
          }
      });
  </script>
</x-app-layout>
