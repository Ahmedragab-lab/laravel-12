@foreach ($product->sizes as $size)
    <span class=" badge badge-pill badge-warning mb-2" style="width: 30px;height: 20px;font-size: 12px;">
        {{ $size->name }}
    </span>
@endforeach
