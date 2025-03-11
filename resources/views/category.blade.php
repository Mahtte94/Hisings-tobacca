<x-app-layout>
  <div class="max-w-4xl mx-auto p-6">
      <div class="flex items-center justify-between mb-6">
          <h1 class="text-white text-2xl font-bold">{{ $category->name }}</h1>
          <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">Back to All Products</a>
      </div>

      <p class="text-white mb-6">{{ $category->description ?? 'Products in this category' }}</p>

      <div class="grid gap-6 mt-4 sm:grid-cols-2 md:grid-cols-3">
          @forelse($products as $product)
              <a href="{{ route('show', $product->id) }}" 
                  class="bg-gray-700 rounded-lg shadow-md p-4 flex flex-col max-h-80 transition transform hover:scale-105 hover:shadow-xl">
                  <h2 class="mx-auto text-xl font-semibold text-white hover:text-blue-500">
                      {{ $product->name }}
                  </h2>

                  <img 
                      src="{{ asset('storage/' . $product->image) }}" 
                      alt="{{ $product->name }}" 
                      class="w-full h-32 object-contain rounded-lg mt-2 mb-2"
                  >

                   <!-- Product Strength -->

                <div id="productStrength" data-strength="{{ $product->strength }}" class="flex items-center space-x-1">
                    @for ($i = 1; $i <= 6; $i++)
                        <span class="w-4 h-4 border border-white rounded-full  
                            @if($i <= $product->strength) bg-white @endif">
                        </span>
                    @endfor
                </div>

                  <p class="text-white mt-2 overflow-hidden break-words">
                      {{ Str::limit($product->description, 60) }}
                  </p>

                  @if(strlen($product->description) > 100)
                  <p class="text-blue-200 font-semibold">See More</p>
                  @endif

                  <p class="text-blue-200 font-bold">${{ $product->price }}</p>
              </a>
          @empty
              <p class="text-white col-span-3 text-center py-8">No products found in this category.</p>
          @endforelse
      </div>

      {{ $products->links('pagination.custom') }}
  </div>
</x-app-layout>

