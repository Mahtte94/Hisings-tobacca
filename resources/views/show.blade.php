<x-app-layout>
  <div class="p-16">
    <!-- Ensure flex layout with constraints on height -->
    <div class="max-w-xl mx-auto p-6 bg-gray-700 rounded-lg shadow-md flex flex-col h-[500px] sm:h-[600px] md:h-[800px] lg:h-[1000px] overflow-y-auto">
      <!-- Product Name -->
      <h1 class="mx-auto text-white text-3xl font-bold mb-4">{{ $product->name }}</h1>

      <!-- Product Image -->
      <img 
          src="{{ asset('storage/' . $product->image) }}" 
          alt="{{ $product->name }}" 
          class="w-48 mx-auto max-w-md  rounded-lg shadow-md"
      >

      <!-- Product Description -->
      <p class="mt-4 text-white flex-grow">{{ $product->description }}</p>

      <!-- Product Price -->
      <p class="mt-2 text-lg font-semibold text-blue-500">${{ $product->price }}</p>

      <!-- Action Buttons -->
      <div class="mt-6 flex space-x-4">
          <a 
              href="{{ route('edit', $product->id) }}" 
              class="bg-blue-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-600"
          >
              Edit
          </a>

          <!-- Delete Form -->
          <form method="POST" action="{{ route('destroy', $product) }}" 
              onsubmit="return confirm('Are you sure you want to delete this product?');"
          >
              @method('DELETE')
              @csrf

              <button 
                  type="submit" 
                  class="bg-red-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-600"
              >
                  Delete
              </button>
          </form>
      </div>
    </div>
  </div>
</x-app-layout>
