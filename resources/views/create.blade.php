<x-app-layout>
  <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
      <h1 class="text-2xl font-bold mb-6">New Product</h1>

      <!-- Display Errors -->
      @if ($errors->any())
          <ul class="mb-4 p-4 bg-red-100 text-red-600 rounded-lg">
              @foreach ($errors->all() as $error)
                  <li class="list-disc ml-4">{{ $error }}</li>
              @endforeach
          </ul>
      @endif

      <!-- Product Form -->
      <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data" class="space-y-4">
          @csrf

          <!-- Item Name -->
          <div>
              <label for="name" class="block font-semibold">Item Name</label>
              <input 
                  type="text" 
                  name="name" 
                  id="name" 
                  value="{{ old('name') }}" 
                  class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200"
              >
          </div>

          <!-- Image Upload -->
          <div>
              <label for="image" class="block font-semibold">Upload Image</label>
              <input 
                  type="file" 
                  name="image" 
                  id="imageInput" 
                  class="w-full p-2 border border-gray-300 rounded-lg"
              >
          </div>

          <!-- Image Preview -->
          <div class="mt-2">
              <img 
                  id="imagePreview" 
                  src="" 
                  alt="Image Preview" 
                  class="hidden w-48 h-48 object-cover rounded-lg border border-gray-300"
              >
          </div>

          <!-- Description -->
          <div>
              <label for="description" class="block font-semibold">Description</label>
              <textarea 
                  name="description" 
                  id="description" 
                  class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200"
              >{{ old('description') }}</textarea>
          </div>

          <!-- Price -->
          <div>
              <label for="price" class="block font-semibold">Price</label>
              <input 
                  type="text" 
                  name="price" 
                  id="price" 
                  value="{{ old('price') }}" 
                  class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200"
              >
          </div>

          <!-- Submit Button -->
          <button 
              type="submit" 
              class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600"
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
