@php use Illuminate\Support\Facades\Auth; @endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
</head>

<body>

    <form method="post" action="/login">
        <div>
            <label for="email">Email</label>
            <input name="email" id="email" type="email" />
        </div>
        <div>
            <label for="password">Password</label>
            <input name="password" id="password" type="password" />
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <button type="submit">Login</button>
    </form>
    <input type="text" id="search" placeholder="Search products...">
    <div id="product-list" style="display: none;"></div>
    @auth
    <a href="{{ route('create') }}">Add new product</a>
    @endauth


    <div id="allProducts" style="display: block">
        <div>
            <h1>Products</h1>
            @foreach($products as $product)

            <a href="{{ route('show', $product->id)  }}">{{ $product->name }}</a>
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name}}">
            <p>{{ $product->description }}</p>
            <p>{{ $product->strength }}</p>
            <p>{{ $product->type }}</p>
            <p>{{ $product->price }}</p>

            @endforeach

            {{ $products->links() }}
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


</body>

</html>