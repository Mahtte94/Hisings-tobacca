@php use Illuminate\Support\Facades\Auth; @endphp
<h1>{{ $product->name }}</h1>
<img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name}}">
<p> {{ $product->description }} </p>
<p>{{ $product->strength }}</p>
<p>{{ $product->type }}</p>
<p> {{ $product->price }} </p>

@auth
<a href="{{ route('edit', $product->id) }}">Edit</a>

@if(auth()->user()->isAdmin())
<form method="post" action="{{ route('destroy', $product) }}">
    @method('DELETE')
    @csrf

    <button>Delete</button>
</form>
@endif
@endauth