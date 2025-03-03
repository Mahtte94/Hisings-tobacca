<h1>Edit product</h1>

<form method="post" action="{{ route('update', $product) }}" enctype="multipart/form-data">
  @method('PATCH')
  @csrf

  <label for="name">Item name</label>
  <input type="text" name="name" id="name" value=" {{ $product->name }}">

  <label for="image">Upload Image</label>
  <input type="file" name="image" id="imageInput" {{ $product->image }}">

  @if($product->image)
  <div>
    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name}}">
  </div>
  @endif

  <label for="description">Description</label>
  <textarea name="description" id="description">{{ $product->description }}</textarea>

  <label for="strength">Strength</label>
  <input type="number" name="strength" id="strength" min="0" value="{{ $product->strength}}">

  <label for="type">Type</label>
  <select name="type" id="type">
    <option value="white" {{ $product->type == 'white' ? 'selected' : '' }}>White</option>
    <option value="brown" {{ $product->type == 'brown' ? 'selected' : '' }}>Brown</option>
  </select>

  <label for="price">Price</label>
  <input type="text" name="price" id="price" value="{{ $product->price }}">

  <button>Edit Product</button>
</form>