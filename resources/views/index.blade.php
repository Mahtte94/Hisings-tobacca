<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <!-- Search Bar -->
        <input 
            type="text" 
            id="search" 
            placeholder="Search products..." 
            class="w-1/4 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
        >
        
        <!-- Search Results -->
        <div id="product-list" class="hidden text-white mt-6 space-y-4"></div>

        <!-- All Products -->

        <div id="allProducts" class="mt-6">
            @if(auth()->user()->isAdmin())
            <a 
                href="{{ route('create') }}" 
                class="block text-white bg-blue-500 hover:bg-blue-600 font-bold py-2 px-4 rounded text-center w-1/4"
            >
                Add New Product
            </a>
            @endif
            <h1 class="text-white text-2xl font-bold mt-6">Products</h1>

            <div class="grid gap-6 mt-4 sm:grid-cols-2 md:grid-cols-3">
                @foreach($products as $product)
                    <!-- Wrap the entire product card in a link -->
                    <a href="{{ route('show', $product->id) }}" 
                        class="bg-gray-700 rounded-lg shadow-md p-4 flex flex-col h-80 transition transform hover:bg-gray-600 hover:scale-105 hover:shadow-xl">
                        <!-- Product Name -->
                        <h2 class="mx-auto text-xl font-semibold text-white hover:text-blue-500">
                            {{ $product->name }}
                        </h2>

                        <!-- Image -->
                        <img 
                            src="{{ asset('storage/' . $product->image) }}" 
                            alt="{{ $product->name }}" 
                            class="w-full h-32 object-contain rounded-lg mt-2"
                        >

                        <!-- Description -->
                        <p class="text-white mt-2 overflow-hidden break-words">
                            {{ Str::limit($product->description, 60) }}
                        </p>

                        @if(strlen($product->description) > 100)
                        <p class="text-blue-500 font-semibold">See More</p>
                        @endif

                        <!-- Price -->
                        <p class="text-blue-500 font-bold">${{ $product->price }}</p>
                    </a> <!-- End of the link wrapping the product card -->
                @endforeach
            </div>
            {{ $products->links('pagination.custom') }}
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('search').addEventListener('input', function() {
        let query = this.value.trim();

        if (query.length === 0) {
            document.getElementById('allProducts').style.display = "flex";
            document.getElementById('product-list').style.display = "none";
            return;
        }

        fetch(`/search-products?query=${query}`)
            .then(response => response.json())
            .then(products => {
                let output = ` <a 
                href="{{ route('create') }}" 
                class="flex text-white bg-blue-500 hover:bg-blue-600 font-bold py-2 px-4 rounded text-center w-1/4"
            >
                Add New Product
            </a>
                <h1 class="text-2xl font-bold mt-6 text-white">Search Results</h1>`;
                
                if (products.length > 0) {
                    output += `<div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">`;

                    products.forEach(product => {
                        output += `
                            <a href="/products/${product.id}" 
                                class="bg-gray-700 rounded-lg shadow-md p-4 flex flex-col h-80 transition transform hover:bg-gray-600 hover:scale-105 hover:shadow-xl">
                                <h2 class="mx-auto text-xl font-semibold text-white">
                                    ${product.name}
                                </h2>
                                <img 
                                    src="/storage/${product.image}" 
                                    class="w-full h-32 object-contain rounded-lg mt-2"
                                >
                                <p class="text-white mt-2 overflow-hidden break-words">${product.description.length > 100 ? product.description.substring(0, 60) + '...' : product.description}</p>
                                ${product.description.length > 100 ? '<p class="text-blue-500 font-semibold">See More</p>' : ''}
                                <p class="text-blue-500 font-bold">$${product.price}</p>
                            </a>
                            
                        `;
                    });

                    output += `</div>
                    {{ $products->links('pagination.custom') }}`;
                } else {
                    output = `<p class="text-gray-500 text-lg">No products found.</p>`;
                }

                document.getElementById('product-list').innerHTML = output;
                document.getElementById('product-list').style.display = "flex";
                document.getElementById('allProducts').style.display = "none";
            });
    });
</script>
