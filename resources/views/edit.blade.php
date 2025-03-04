<x-view.layout>
  <h1>Edit product</h1>

  <x-errors />

  <form method="post" action="{{ route('update', $product) }}" enctype="multipart/form-data">
    @method('PATCH')
    <x-forms.form :product="$product" />
  </form>
</x-view.layout>