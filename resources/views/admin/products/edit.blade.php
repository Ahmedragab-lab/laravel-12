@extends('admin.layouts.master')
@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fileinput/css/fileinput.min.css') }}">
@endpush
@section('content')
    <div>
        <h2>@lang('products.products')</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">@lang('products.products')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data"
                    id='product-form' class="insert_form product_insert_form ">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.name')<span class="text-danger">*</span></label>
                                @include('admin.components.input', [
                                    'name' => 'product_name',
                                    'type' => 'text',
                                    'value' => $product->product_name,
                                ])
                            </div>
                            @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.Category')<span class="text-danger">*</span></label>
                                @include('admin.components.select', [
                                    'name' => 'category_id',
                                    'attributes' => '',
                                    'class' => 'multiple-select ',
                                    'collection' => $categories,
                                    'action' => route('addCategory'),
                                    'value' => $product->category_id,
                                    'fields' => [
                                        ['name' => 'name', 'type' => 'text'],
                                        ['name' => 'image', 'type' => 'file'],
                                    ],
                                ])
                            </div>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>البرندات<span class="text-danger">*</span></label>
                                @include('admin.components.select', [
                                    'name' => 'brand_id',
                                    'attributes' => '',
                                    'class' => 'multiple-select',
                                    'collection' => $brands,
                                    'action' => route('addBrand'),
                                    'value' => $product->brand_id,
                                    'fields' => [
                                        ['name' => 'name', 'type' => 'text'],
                                        ['name' => 'logo', 'type' => 'file'],
                                    ],
                                ])
                            </div>
                            @error('brand')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.colors')<span class="text-danger">*</span></label>
                                @include('admin.components.select', [
                                    'name' => 'color_id',
                                    'attributes' => 'multiple',
                                    'class' => 'multiple-select',
                                    'collection' => $colors,
                                    'action' => route('addColor'),
                                    'value' => $product->color,
                                    'fields' => [['name' => 'name', 'type' => 'text']],
                                ])
                            </div>
                            @error('color_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.sizes')<span class="text-danger">*</span></label>
                                @include('admin.components.select', [
                                    'name' => 'size_id',
                                    'attributes' => 'multiple',
                                    'class' => 'multiple-select',
                                    'collection' => $sizes,
                                    'action' => route('addSize'),
                                    'value' => $product->size,
                                    'fields' => [['name' => 'name', 'type' => 'text']],
                                ])
                            </div>
                            @error('size_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.Expiration_Date')<span class="text-danger">*</span></label>
                                @include('admin.components.input', [
                                    'name' => 'expiration_date',
                                    'type' => 'date',
                                    'value' => $product->expiration_date,
                                ])
                            </div>
                            @error('expiration_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.Discount')<span class="text-danger">*</span></label>
                                @include('admin.components.input', [
                                    'name' => 'discount',
                                    'type' => 'number',
                                    'value' => $product->discount,
                                ])
                            </div>
                            @error('discount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.price')<span class="text-danger">*</span></label>
                                @include('admin.components.input', [
                                    'name' => 'price',
                                    'type' => 'number',
                                    'attr' => "step='0.01'",
                                    'value' => $product->price,
                                ])
                            </div>
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.stock')<span class="text-danger">*</span></label>
                                @include('admin.components.input', [
                                    'name' => 'stock',
                                    'type' => 'number',
                                    'value' => $product->stock,
                                ])
                            </div>
                            @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.status')<span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option {{ $product->status == 0 ? 'selected' : '' }} value=0>Off</option>
                                    <option {{ $product->status == 1 ? 'selected' : '' }} value=1>On</option>
                                </select>
                            </div>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.image') </label>
                                <input class="form-control img " name="image" type="file" accept="image/*">
                            </div>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            @if ($product->image)
                                <img src="{{ display_file($product->image) }}" alt="{{ $product->name }}"
                                    class="img-thumbnail img-preview" width="100px">
                            @else
                                <img src="{{ asset('no-image.jpg') }}" alt="" class="img-thumbnail img-preview"
                                    width="200px">
                            @endif
                        </div>
                    </div>
                    {{-- images  --}}
                    <div class="row">
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class=" col-form-label">@lang('products.desc')</label>
                                <div class="">
                                    <textarea name="description" class="form-control ckeditor">{{ $product->description }}</textarea>
                                    <span class="text-danger description"></span>
                                </div>
                            </div>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            {{-- files --}}
                            <div class="form-group">
                                <label for="">صور المنتجات لا تزعل</label>
                                <input type="file" name="products_images[]" id="products_images"
                                    class="form-control file-input-overview" multiple accept="image/*">
                                @error('products_images.*')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary px-5"><i class="icon-lock"></i>حفظ</button>
                            </div>
                        </div>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
@endsection
@push('js')
    <script src="{{ asset('fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('fileinput/themes/bs5/theme.min.js') }}"></script>
    <script>
        $("#products_images").fileinput({
            theme: "bs5",
            maxFileCount: 5,
            allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg', 'svg'],
            showCancel: true,
            showRemove: false,
            showUpload: false,
            overwriteInitial: false,
            initialPreview: [
                @if ($product->images()->count() > 0)
                    @foreach ($product->images as $image)
                        "{{ asset('uploads/products_images/' . $image->file_name) }}",
                    @endforeach
                @endif
            ],
            initialPreviewAsData: true,
            initialPreviewConfig: [
                @if ($product->images()->count() > 0)
                    @foreach ($product->images as $media)
                        {
                            caption: "{{ $media->file_name }}",
                            size: "{{ $media->size }}", // Assuming you have a size attribute
                            width: "120px",
                            url: "{{ route('products.remove_cert', ['image_id' => $media->id, 'product_id' => $product->id, '_token' => csrf_token()]) }}",
                            key: {{ $media->id }},
                            type: "{{ in_array(pathinfo($media->file_name, PATHINFO_EXTENSION), ['jpg', 'png', 'gif', 'jpeg', 'svg']) ? 'image' : 'pdf' }}"
                        },
                    @endforeach
                @endif
            ],
        }).on('filesorted', function(event, params) {
            console.log(params.previewId, params.oldIndex, params.newIndex, params.stack);
        });
    </script>


    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ProductRequest', '#product-form') !!}
@endpush
{{--  --}}
