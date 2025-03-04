<h1>New Product</h1>

@if ($errors->any())
<ul>
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</ul>
@endif

<form method="post" action="{{ route('store') }}" enctype="multipart/form-data">
  @csrf

  <label for="name">Item name</label>
  <input type="text" name="name" id="name" value=" {{ old('name')}}">

  <label for="image">Upload Image</label>
  <input type="file" name="image" id="image" {{ old('image')}}">

  <img id="imagePreview" src="" alt="Image Preview">

  <label for="description">Description</label>
  <textarea name="description" id="description">{{ old('description')}}</textarea>

  <label for="strength">Strength</label>
  <input type="number" name="strength" id="strength" min="0" value="{{ old('strength') }}">

  <label for="type">Type</label>
  <select name="type" id="type">
    <option value="white" {{ old('type') == 'white' ? 'selected' : '' }}>White</option>
    <option value="brown" {{ old('type') == 'brown' ? 'selected' : '' }}>Brown</option>
  </select>

  <label for="price">Price</label>
  <input type="text" name="price" id="price" value="{{ old('price')}}">

  <button>Create Product</button>
</form>

<script>
  document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const preview = document.getElementById('imagePreview');
        preview.src = e.target.result;
        preview.style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  });
</script>