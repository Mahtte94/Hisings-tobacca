<x-view.layout>
  <h1>New Product</h1>

  <x-errors />

  <form method="post" action="{{ route('store') }}" enctype="multipart/form-data">
    <x-forms.form :product="$product" />
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
</x-view.layout>