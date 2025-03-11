
@foreach ($product->color as $color)
    <span class=" badge  badge-primary mb-2" style="width: 50px;height: 20px;font-size: 12px;">
        {{$color->name}}
    </span>
@endforeach

