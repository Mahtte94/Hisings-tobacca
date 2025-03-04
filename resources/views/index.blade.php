@php use Illuminate\Support\Facades\Auth; @endphp
<x-view.layout>
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
    @if(auth()->user()->isAdmin())
    <a href="{{ route('create') }}">Add new product</a>
    @endif
    @endauth

    <x-view.display :products="$products" />

</x-view.layout>