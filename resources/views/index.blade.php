<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <!-- Search Bar -->
        <input
            type="text"
            id="search"
            placeholder="Search products..."
            class="w-1/4 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">

        <!-- Search Results -->
        <div id="product-list" class="hidden text-white mt-6 space-y-4"></div>

        <!-- All Products -->

        <div id="allProducts" class="mt-6">
            <div class="flex justify-between items-center">
                @if(auth()->user()->isAdmin())
                <a
                    href="{{ route('create') }}"
                    class="flex text-white bg-blue-500 hover:bg-blue-600 font-bold py-2 px-4 rounded items-center justify-center w-1/4">
                    Add New Product
                </a>
                @endif

                <select id="filter" class="block appearance-none text-white bg-blue-500 hover:bg-blue-600 font-bold py-2 px-4 rounded items-center justify-center w-1/4">
                    <option value="name_asc" {{ $sort == 'name' && $direction == 'asc' ? 'selected' : '' }}>Sort by name ASC</option>
                    <option value="name_desc" {{ $sort == 'name' && $direction == 'desc' ? 'selected' : '' }}>Sort by name DESC</option>
                    <option value="price_asc" {{ $sort == 'price' && $direction == 'asc' ? 'selected' : '' }}>Sort by price ASC</option>
                    <option value="price_desc" {{ $sort == 'price' && $direction == 'desc' ? 'selected' : '' }}>Sort by price DESC</option>
                    <option value="strength_asc" {{ $sort == 'strength' && $direction == 'asc' ? 'selected' : '' }}>Sort by strength ASC</option>
                    <option value="strength_desc" {{ $sort == 'strength' && $direction == 'desc' ? 'selected' : '' }}>Sort by strength DESC</option>
                </select>
            </div>

            <h1 class="text-white text-2xl font-bold mt-6">Products</h1>

            <div class="grid gap-6 mt-4 sm:grid-cols-2 md:grid-cols-3">
                @foreach($products as $product)
                <!-- Wrap the entire product card in a link -->
                <a href="{{ route('show', $product->id) }}"
                    class="bg-gray-700 rounded-lg shadow-md p-4 flex flex-col h-80 transition transform hover:scale-105 hover:shadow-xl">
                    <!-- Product Name -->
                    <h2 class="mx-auto text-xl font-semibold text-white hover:text-blue-500">
                        {{ $product->name }}
                    </h2>

                    <!-- Image -->
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-32 object-contain rounded-lg mt-2 mb-2">

                    <!-- Product Strength -->

                    <div id="productStrength" data-strength="{{ $product->strength }}" class="flex items-center space-x-1">
                        @for ($i = 1; $i <= 6; $i++)
                            <span class="w-4 h-4 border border-white rounded-full  
                                            @if($i <= $product->strength) bg-white @endif">
                            </span>
                            @endfor
                    </div>

                    <!-- Description -->
                    <p class="text-white mt-2 overflow-hidden break-words">
                        {{ Str::limit($product->description, 60) }}
                    </p>

                    @if(strlen($product->description) > 60)
                    <p class="text-blue-200 font-semibold">See More</p>
                    @endif

                    <!-- Price -->
                    <p class="text-blue-200 font-bold">{{ $product->price }}:-</p>

                </a> <!-- End of the link wrapping the product card -->
                @endforeach
            </div>
            {{ $products->links('pagination.custom') }}
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('filter').addEventListener('change', function() {
        const value = this.value;
        const [sort, direction] = value.split('_');

        window.location.href = `{{ route('dashboard') }}?sort=${sort}&direction=${direction}`;
    });

    document.getElementById('search').addEventListener('input', function() {
        let query = this.value.trim();

        if (query.length === 0) {
            document.getElementById('allProducts').style.display = "block";
            document.getElementById('product-list').style.display = "none";
            return;
        }

        fetch(`/search-products?query=${query}`)
            .then(response => response.json())
            .then(products => {
                let output = ` <a 
                href="{{ route('create') }}" 
                class="flex text-white bg-blue-500 hover:bg-blue-600 font-bold py-2 px-4 rounded items-center justify-center w-1/4"
            >
                Add New Product
            </a>
                <h1 class="text-white text-2xl font-bold mt-6">Search Results</h1>`;

                if (products.length > 0) {
                    output += `<div class="grid gap-6 mt-4 sm:grid-cols-2 md:grid-cols-3">`;

                    products.forEach(product => {

                        let strengthHtml = '<div class="flex items-center space-x-1">';
                    for (let i = 1; i <= 6; i++) {
                        strengthHtml += `<span class="w-4 h-4 border border-white rounded-full ${i <= product.strength ? 'bg-white' : ''}"></span>`;
                    }
                    strengthHtml += '</div>';
                        output += `
                            <a href="/products/${product.id}" 
                                class="bg-gray-700 rounded-lg shadow-md p-4 flex flex-col h-80 transition transform hover:scale-105 hover:shadow-xl">
                                <h2 class="mx-auto text-xl font-semibold text-white">
                                    ${product.name}
                                </h2>
                                <img 
                                    src="/storage/${product.image}" 
                                    class="w-full h-32 object-contain rounded-lg mt-2 mb-2"
                                >

                                 ${strengthHtml}
                               
                                <p class="text-white mt-2 overflow-hidden break-words">${product.description.length > 100 ? product.description.substring(0, 60) + '...' : product.description}</p>
                                ${product.description.length > 100 ? '<p class="text-blue-200 font-semibold">See More</p>' : ''}
                                <p class="text-blue-200 font-bold">${product.price}:-</p>
                            </a>
                            
                        `;
                    });

                    output += `</div>
                    {{ $products->appends(['sort' => $sort, 'direction' => $direction])->links('pagination.custom') }}`;
                } else {
                    output = `<p class="text-gray-500 text-lg">No products found.</p>`;
                }

                document.getElementById('product-list').innerHTML = output;
                document.getElementById('product-list').style.display = "block";
                document.getElementById('allProducts').style.display = "none";
            });
    });
</script>