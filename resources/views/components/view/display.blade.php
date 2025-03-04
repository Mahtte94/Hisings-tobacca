<h1>Products</h1>
<div id="allProducts" style="display: flex">
    @foreach($products as $product)
    <div id="productDisplay">

        <a href="{{ route('show', $product->id)  }}">{{ ucfirst($product->name) }}</a>
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name}}">
        <p>{{ ucfirst($product->description) }}</p>
        <p>{{ $product->strength }}</p>
        <p>{{ ucfirst($product->type) }}</p>
        <p>{{ $product->price }}</p>

    </div>
    @endforeach
</div>
{{ $products->links() }}

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
                document.getElementById('product-list').style.display = "flex";
            });
    });
</script>