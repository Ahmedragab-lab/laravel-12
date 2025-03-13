@extends('admin.layouts.master')
@section('css')

@endsection
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
                <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data"
                    id='product-form ' class="insert_form product_insert_form ">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.name')<span class="text-danger">*</span></label>
                                @include('admin.components.input', [
                                    'name' => 'product_name',
                                    'type' => 'text',
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
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.Category')<span class="text-danger">*</span></label>
                                @include('admin.components.select', [
                                    'name' => 'product_category_id',
                                    'attributes' => 'multiple',
                                    'class' => 'multiple-select product_category',
                                    'collection' => $categories,
                                    'action' => route('admin.addCategory'),
                                    'fields' => [
                                        [
                                            'name' => 'main_category_id',
                                            'type' => 'select',
                                            'option_route' => route('admin.get_main_category_json'),
                                        ],
                                        ['name' => 'name', 'type' => 'text'],
                                        ['name' => 'icon', 'type' => 'file'],
                                    ],
                                ])
                            </div>
                            @error('product_category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>البرندات<span class="text-danger">*</span></label>
                                @include('admin.components.select', [
                                    'name' => 'brand_id',
                                    'attributes' => '',
                                    'class' => 'multiple-select',
                                    'collection' => $brands,
                                    'action' => route('addBrand'),
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
                                    'fields' => [['name' => 'name', 'type' => 'text']],
                                ])
                            </div>
                            @error('size_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.Expiration_Date')<span class="text-danger">*</span></label>
                                @include('admin.components.input', [
                                    'name' => 'expiration_date',
                                    'type' => 'date',
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
                                ])
                            </div>
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.free_delivery')<span class="text-danger">*</span></label>
                                <select name="free_delivery" class="form-control">
                                    <option value="false">Off</option>
                                    <option value="true">On</option>
                                </select>
                            </div>
                            @error('free_delivery')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.stock')<span class="text-danger">*</span></label>
                                @include('admin.components.input', [
                                    'name' => 'stock',
                                    'type' => 'number',
                                ])
                            </div>
                            @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.Alert_Quantity')<span class="text-danger">*</span></label>
                                @include('admin.components.input', [
                                    'name' => 'alert_quantity',
                                    'type' => 'number',
                                ])
                            </div>
                            @error('alert_quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    {{-- images  --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.image') </label>
                                <input class="form-control img " name="image"  type="file" accept="image/*" >
                            </div>
                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            <img src="{{ asset('images/no-image.jpg') }}" alt="" class="img-thumbnail img-preview" width="200px">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class=" col-form-label">@lang('products.desc')</label>
                                <div class="">
                                    <textarea name="description" class="form-control " id="editor"></textarea>
                                    <span class="text-danger description"></span>
                                </div>
                            </div>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class=" col-form-label">@lang('products.feat')</label>
                                <div class="">
                                    <textarea name="features" class="form-control " id="editor1"></textarea>
                                    <span class="text-danger description"></span>
                                </div>
                            </div>
                            @error('features')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
    @include('admin.products.crop-image-modal')
    @include('admin.products.model-crop')
@endsection
@push('js')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.config.language = "{{ app()->getLocale() }}";
        CKEDITOR.replace('editor');
        CKEDITOR.replace('editor1');
    </script>

    {{-- <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js') }}"></script> --}}
    {{-- {!! JsValidator::formRequest('App\Http\Requests\Admin\ProductRequest', '#product-form') !!} --}}


@endpush
{{--  --}}
