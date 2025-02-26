<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
</head>
<body>

    <a href="{{ route('create') }}">Add new product</a>

    <h1>Products</h1>
   
    @foreach($products as $product)

        <h2>{{ $product->name }}</h2>
        <p>{{ $product->description }}</p>
        <p>{{ $product->price }}</p>
        
    @endforeach
   
    
    
    
    
</body>
</html>
