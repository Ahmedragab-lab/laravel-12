@if ($product->image)
    <img src="{{ display_file($product->image) }}" width="70" alt="{{ $product->name }}">
@else
    <img src="{{ asset('no-image.jpg') }}" alt="{{ $product->name }} " width="70">
@endif
