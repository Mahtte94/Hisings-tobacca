<p>Hello, {{ $user->name }}</p>
<hr>
<input type="text" id="search" placeholder="Search products...">
<div id="product-list" style="display: none;"></div>
<a href="{{ route('create') }}">Add new product</a>


<div id="allProducts" style="display: block">
    <div>
        <h1>Products</h1>
        @foreach($products as $product)

        <a href="{{ route('show', $product->id)  }}">{{ $product->name }}</a>
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name}}">
        <p>{{ $product->description }}</p>
        <p>{{ $product->price }}</p>

        @endforeach
        <div>
        </div>


        <script>
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
                        let output = "<h1>Products</h1>";

                        if (products.length > 0) {

                            products.forEach(product => {

                                output += `
                    
                    <div>
                        <a href="${product.id}">${product.name}</a>
                        <img src="/storage/${product.image}">
                        <p>${product.description}</p>
                        <p>$${product.price}</p>
                        
                    </div>`;

                                document.getElementById('allProducts').style.display = "none";
                            });
                        } else {
                            output = "<p>No products found.</p>";
                        }

                        document.getElementById('product-list').innerHTML = output;
                        document.getElementById('product-list').style.display = "block";
                    });
            });
        </script>
        <hr>
        <a href="/logout">Logout</a>