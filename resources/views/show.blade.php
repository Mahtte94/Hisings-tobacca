

<h1>{{ $product->name }}</h1>
<img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name}}">
<p> {{ $product->description }} </p>
<p> {{ $product->price }} </p>
