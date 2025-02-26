<h1>New Product</h1>

@if ($errors->any())
<ul>
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</ul>
@endif

<form method="post" action=" {{ route('store')}}">
  @csrf

  <label for="name">Item name</label>
  <input type="text" name="name" id="name" value=" {{ old('name')}}">

  <label for="description">Description</label>
  <textarea name="description" id="description">{{ old('description')}}</textarea>

  <label for="price">Price</label>
  <input type="text" name="price" id="price" value="{{ old('price')}}">

  <button>Create Product</button>
</form>