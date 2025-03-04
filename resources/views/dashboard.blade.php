<x-view.layout>
    <p>Hello, {{ $user->name }}</p>
    <hr>
    <input type="text" id="search" placeholder="Search products...">
    <div id="product-list" style="display: none;"></div>
    @if(auth()->user()->isAdmin())
    <a href="{{ route('create') }}">Add new product</a>
    @endif

    <x-view.display :products="$products" />

    <hr>
    <a href="/logout">Logout</a>

</x-view.layout>