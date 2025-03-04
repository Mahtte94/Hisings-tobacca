@csrf

<label for="name">Item name</label>
<input type="text" name="name" id="name" value=" {{ old('name', $product->name ?? '') }}">

<label for="image">Upload Image</label>
<input type="file" name="image" id="image" {{ old('image', $product->image ?? '') }}">

<img id="imagePreview" src="" alt="Image Preview">

<label for="description">Description</label>
<textarea name="description" id="description">{{ old('description', $product->description ?? '') }}</textarea>

<label for="strength">Strength</label>
<input type="number" name="strength" id="strength" min="0" value="{{ old('strength', $product->strength) }}">

<label for="type">Type</label>
<select name="type" id="type">
    <option value="white" {{ old('type', $product->type) == 'white' ? 'selected' : '' }}>White</option>
    <option value="brown" {{ old('type', $product->type) == 'brown' ? 'selected' : '' }}>Brown</option>
</select>

<label for="price">Price</label>
<input type="text" name="price" id="price" value="{{ old('price', $product->price ?? '') }}">

<button>Save</button>