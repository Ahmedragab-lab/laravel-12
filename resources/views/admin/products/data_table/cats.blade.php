
@foreach ($product->category as $color)
    <div class=" badge  badge-warning mb-2" style="width: 100px;height: 20px;font-size: 12px;">
        {{$color->name}}
    </div>
@endforeach
/
<div>
    @foreach ($product->category as $color)
    <span class=" badge  badge-primary mb-2" style="width: 120px;height: 20px;font-size: 12px;">
        {{$color->name}}
    </span>
    @endforeach
</div>

{{-- {{ $product->main_category?->name; }} --}}
