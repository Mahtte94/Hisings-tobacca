<h1>{{ $product->name }}</h1>
<img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name}}">
<p> {{ $product->description }} </p>
<p> {{ $product->price }} </p>

<a href="{{ route('edit', $product->id) }}">Edit</a>

<form method="post" action="{{ route('destroy', $product) }}">
    @method('DELETE')
    @csrf

    <button>Delete</button>
</form>