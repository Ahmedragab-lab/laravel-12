@extends('admin.layouts.master')
@section('css')
{{-- images crop css --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .preview-images-container {
            /* display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px; */
            display: grid;
            grid-template-columns: repeat(auto-fill, 170px);
        }
        .preview-certificates-container {
            /* display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px; */
            display: grid;
            grid-template-columns: repeat(auto-fill, 170px);
        }
        .preview {
            position: relative;
            width: 150px;
            height: 150px;
            padding: 4px;
            box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            margin: 30px 0px;
            border: 1px solid #ddd;
        }

        .preview img {
            width: 100%;
            height: 100%;
            box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            border: 1px solid #ddd;
            object-fit: cover;

        }

        .delete-btn {
            position: absolute;
            top: 156px;
            right: 0px;
            /*border: 2px solid #ddd;*/
            border: none;
            cursor: pointer;
        }

        .delete-btn {
            background: transparent;
            color: rgba(235, 32, 38, 0.97);
        }

        .crop-btn {
            position: absolute;
            top: 156px;
            left: 0px;
            /*border: 2px solid #ddd;*/
            border: none;
            cursor: pointer;
            background: transparent;
            color: #007bff;
        }
    </style>
    <style>
        .variants {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .variants>div {
            margin-right: 5px;
        }

        .variants>div:last-of-type {
            margin-right: 0;
        }

        .file {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .file>input[type='file'] {
            display: none
        }

        .file>label {
            font-size: 1rem;
            font-weight: 300;
            cursor: pointer;
            outline: 0;
            user-select: none;
            border-color: rgb(216, 216, 216) rgb(209, 209, 209) rgb(186, 186, 186);
            border-style: solid;
            border-radius: 4px;
            border-width: 1px;
            background-color: hsl(0, 0%, 100%);
            color: hsl(0, 0%, 29%);
            padding-left: 16px;
            padding-right: 16px;
            padding-top: 16px;
            padding-bottom: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .file>label:hover {
            border-color: hsl(0, 0%, 21%);
        }

        .file>label:active {
            background-color: hsl(0, 0%, 96%);
        }

        .file>label>i {
            padding-right: 5px;
        }

        .file--upload>label {
            color: hsl(204, 86%, 53%);
            border-color: hsl(204, 86%, 53%);
        }

        .file--upload>label:hover {
            border-color: hsl(204, 86%, 53%);
            background-color: hsl(204, 86%, 96%);
        }

        .file--upload>label:active {
            background-color: hsl(204, 86%, 91%);
        }

        .file--uploading>label {
            color: hsl(48, 100%, 67%);
            border-color: hsl(48, 100%, 67%);
        }

        .file--uploading>label>i {
            animation: pulse 5s infinite;
        }

        .file--uploading>label:hover {
            border-color: hsl(48, 100%, 67%);
            background-color: hsl(48, 100%, 96%);
        }

        .file--uploading>label:active {
            background-color: hsl(48, 100%, 91%);
        }

        .file--success>label {
            color: hsl(141, 71%, 48%);
            border-color: hsl(141, 71%, 48%);
        }

        .file--success>label:hover {
            border-color: hsl(141, 71%, 48%);
            background-color: hsl(141, 71%, 96%);
        }

        .file--success>label:active {
            background-color: hsl(141, 71%, 91%);
        }

        .file--danger>label {
            color: hsl(348, 100%, 61%);
            border-color: hsl(348, 100%, 61%);
        }

        .file--danger>label:hover {
            border-color: hsl(348, 100%, 61%);
            background-color: hsl(348, 100%, 96%);
        }

        .file--danger>label:active {
            background-color: hsl(348, 100%, 91%);
        }

        .file--disabled {
            cursor: not-allowed;
        }

        .file--disabled>label {
            border-color: #e6e7ef;
            color: #e6e7ef;
            pointer-events: none;
        }

        @keyframes pulse {
            0% {
                color: hsl(48, 100%, 67%);
            }

            50% {
                color: hsl(48, 100%, 38%);
            }

            100% {
                color: hsl(48, 100%, 67%);
            }
        }
    </style>
    {{-- images crop js --}}
@endsection
@section('content')
    <div>
        <h2>@lang('products.products')</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">@lang('products.products')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <form method="post" action="{{ route('admin.products.update',$product->id) }}" enctype="multipart/form-data" id='product-form ' class="update_form product_insert_form ">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.name')<span class="text-danger">*</span></label>
                                @include('admin.components.input',[
                                        'name' => 'product_name',
                                        'type' => 'text',
                                        'value' => $product->name,
                                    ])
                            </div>
                            @error('product_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.MainCategory')<span class="text-danger">*</span></label>
                                @include('admin.components.select',[
                                    'name' => 'product_main_category_id',
                                    'attributes' => '',
                                    'class' => 'multiple-select product_main_category',
                                    'collection' => $maincategories,
                                    'value' => $product->main_category()->first() ? $product->main_category()->first()->id : '',
                                    'action' => route('admin.addMainCategory'),
                                    'fields' => [
                                        ['name' => 'name','type' => 'text'],
                                        ['name' => 'icon','type' => 'file'],
                                    ]
                                ])
                            </div>
                            @error('product_main_category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.Category')<span class="text-danger">*</span></label>
                                @include('admin.components.select',[
                                    'name' => 'product_category_id',
                                    'attributes' => 'multiple',
                                    'class' => 'multiple-select product_category',
                                    'collection' => $categories,
                                    'action' => route('admin.addCategory'),
                                    'value' => $product->category,
                                    'fields' => [
                                        ['name' => 'main_category_id','type' => 'select','option_route'=>route('admin.get_main_category_json')],
                                        ['name' => 'name','type' => 'text'],
                                        ['name' => 'icon','type' => 'file'],
                                    ]
                                ])
                            </div>
                            @error('product_category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.SubCategory')<span class="text-danger">*</span></label>
                                @include('admin.components.select',[
                                        'name' => 'product_sub_category_id',
                                        'attributes' => 'multiple',
                                        'class' => 'multiple-select product_sub_category',
                                        'collection' => $sub_categories,
                                        'action' => route('admin.addSubCategory'),
                                        'fields' => [
                                            [
                                                'name' => 'main_category_id',
                                                'type' => 'select',
                                                'option_route'=>route('admin.get_main_category_json'),
                                                'class' => 'component_modal_main_category parent_select',
                                                'this_field_will_contorl' => 'component_modal_category',
                                                'this_field_control_route' => route('admin.get_all_cateogory_selected_by_main_category',''),
                                            ],
                                            [
                                                'name' => 'category_id',
                                                'class' => 'component_modal_category',
                                                'type' => 'select',
                                                'option_route'=>''
                                            ],
                                            ['name' => 'name','type' => 'text'],
                                            ['name' => 'icon','type' => 'file'],
                                        ]
                                ])
                            </div>
                            @error('product_sub_category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.brands')<span class="text-danger">*</span></label>
                                @include('admin.components.select',[
                                        'name' => 'brand_id',
                                        'attributes' => '',
                                        'class' => 'multiple-select',
                                        'collection' => $brands,
                                        'action' => route('admin.addBrand'),
                                        'value' => $product->brand_id,
                                        'fields' => [
                                            ['name' => 'name','type' => 'text'],
                                            ['name' => 'icon','type' => 'file'],
                                        ]
                                    ])
                            </div>
                            @error('brand')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.colors')<span class="text-danger">*</span></label>
                                @include('admin.components.select',[
                                    'name' => 'color_id',
                                    'attributes' => 'multiple',
                                    'class' => 'multiple-select',
                                    'collection' => $colors,
                                    'action' => route('admin.addColor'),
                                    'value' => $product->color,
                                    'fields' => [
                                        ['name' => 'name', 'type' => 'text'],
                                    ]
                                ])
                            </div>
                            @error('color_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.sizes')<span class="text-danger">*</span></label>
                                @include('admin.components.select',[
                                        'name' => 'size_id',
                                        'attributes' => 'multiple',
                                        'class' => 'multiple-select',
                                        'collection' => $sizes,
                                        'action' => route('admin.addSize'),
                                        'value' => $product->size,
                                        'fields' => [
                                            ['name' => 'name', 'type' => 'text'],
                                    ]
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
                                <label>@lang('products.vendors')<span class="text-danger">*</span></label>
                                @include('admin.components.select',[
                                        'name' => 'vendor_id',
                                        'attributes' => 'multiple',
                                        'class' => 'multiple-select',
                                        'collection' => $vendors,
                                        'action' => route('admin.addVendor'),
                                        'value' => $product->vendor,
                                        'fields' => [
                                            ['name' => 'name', 'type' => 'text'],
                                            ['name' => 'email', 'type' => 'email'],
                                            ['name' => 'mobile_no', 'type' => 'text'],
                                            ['name' => 'image', 'type' => 'file'],
                                            ['name' => 'address', 'type' => 'textarea'],
                                            ['name' => 'description', 'type' => 'textarea'],
                                        ]
                                    ])
                            </div>
                            @error('vendor_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.units')<span class="text-danger">*</span></label>
                                @include('admin.components.select',[
                                    'name' => 'unit_id',
                                        'attributes' => 'multiple',
                                        'class' => 'multiple-select',
                                        'collection' => $units,
                                        'action' => route('admin.addUnit'),
                                        'value' => $product->unit,
                                        'fields' => [
                                            ['name' => 'name', 'type' => 'text'],
                                        ]
                                    ])
                            </div>
                            @error('unit_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.Writers')<span class="text-danger">*</span></label>
                                @include('admin.components.select',[
                                    'name' => 'writer_id',
                                        'attributes' => 'multiple',
                                        'class' => 'multiple-select',
                                        'collection' => $writers,
                                        'action' => route('admin.addWriter'),
                                        'value' => $product->writer,
                                        'fields' => [
                                            ['name' => 'name','type' => 'text'],
                                            ['name' => 'image','type' => 'file'],
                                            ['name' => 'description','type' => 'textarea'],
                                        ]
                                    ])
                            </div>
                            @error('writer_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.Publications')<span class="text-danger">*</span></label>
                                @include('admin.components.select',[
                                    'name' => 'publication_id',
                                        'attributes' => 'multiple',
                                        'class' => 'multiple-select',
                                        'collection' => $publications,
                                        'action' => route('admin.addPublication'),
                                        'value' => $product->publication,
                                        'fields' => [
                                            ['name' => 'name','type' => 'text'],
                                            ['name' => 'image','type' => 'file'],
                                            ['name' => 'description','type' => 'textarea'],
                                        ]
                                    ])
                            </div>
                            @error('publication_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.Expiration_Date')<span class="text-danger">*</span></label>
                                @include('admin.components.input',[
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
                                @include('admin.components.input',[
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
                                <label>@lang('products.tax')<span class="text-danger">*</span></label>
                                @include('admin.components.input',[
                                'name' => 'tax',
                                    'type' => 'number',
                                    'value' => $product->tax,
                                ])
                            </div>
                            @error('tax')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.price')<span class="text-danger">*</span></label>
                                @include('admin.components.input',[
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
                                <label>@lang('products.status')<span class="text-danger">*</span></label>
                                <select name="status"  class="form-control">
                                    @foreach ($status as $item)
                                    <option {{ $item->id == $product->status ? 'selected' : '' }} value="{{ $item->serial }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.free_delivery')<span class="text-danger">*</span></label>
                                <select name="free_delivery"  class="form-control">
                                    <option {{ $product->free_delivery == 'false' ? 'selected' : '' }} value="false">Off</option>
                                    <option {{ $product->free_delivery == 'true' ? 'selected' : '' }}  value="true">On</option>
                                </select>
                            </div>
                            @error('free_delivery')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('products.stock')<span class="text-danger">*</span></label>
                                @include('admin.components.input',[
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
                                <label>@lang('products.Alert_Quantity')<span class="text-danger">*</span></label>
                                @include('admin.components.input',[
                                        'name' => 'alert_quantity',
                                        'type' => 'number',
                                        'value' => $product->minimum_amount,
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
                                <input class="form-control img " name="thumb_image"  type="file" accept="image/*" >
                            </div>
                            @error('thumb_image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-3">
                            @if($product->thumb_image)
                                <img src="{{display_file($product->thumb_image)}}" alt="{{ $product->name }}" class="img-thumbnail img-preview" width="200px">
                            @else
                                <img src="{{ asset('no-image.jpg') }}" alt="" class="img-thumbnail img-preview" width="200px">
                            @endif
                        </div>
                    </div>
                        {{-- test crooooooooop --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">{{ trans('product.image') }}</label>
                                <div class="container mt-3">
                                    <div class="row mx-0"
                                            style="border: 1px solid #ddd;padding: 30px 0px;">
                                        <div class="col-12">
                                            <div class="mt-3">
                                                <div class="row">
                                                    <div class="col-10 offset-1">
                                                        <div class="variants">
                                                            <div class='file file--upload w-100'>
                                                                <label for='file-input-images'
                                                                        class="w-100">
                                                                    <i class="fas fa-cloud-upload-alt"></i>Upload
                                                                </label>
                                                                <!-- <input  id="file-input" multiple type='file' /> -->
                                                                <input type="file"
                                                                    name="cropImages[]"
                                                                        id="file-input-images"
                                                                        multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-10 offset-1">
                                            <div class="preview-images-container">
                                                @if($product->image()->count() > 0)
                                                    @foreach($product->image as $index=>$media)
                                                        <div id="preview{{ $index + 1 }}" class="preview">
                                                            <img
                                                                src="{{asset('uploads/productImage/' . $media->file_name)}}"
                                                                id="img{{  $index + 1 }}" alt="">
                                                                <input type='text' hidden name='old_media[]'  value="{{$media->id}}">

                                                            <div class="action_div"></div>
                                                            <button type="button"
                                                                    class="delete-btn"><i
                                                                    style="font-size: 20px;"
                                                                    id="deleteBtn{{ $index + 1 }}"
                                                                    class="fas fa-trash"></i>
                                                            </button>
                                                            <button type="button"
                                                                    data-toggle="modal"
                                                                    id="cropBtn{{ $index + 1 }}"
                                                                    data-target="#imagesModal"
                                                                    class="crop-btn"><i
                                                                    style="font-size: 20px;"
                                                                    class="fas fa-crop"></i>
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('cropImages')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                        {{-- test crooooooooop --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="" class=" col-form-label">@lang('products.desc')</label>
                                <div class="">
                                    <textarea name="description" class="form-control " id="editor" >{!! $product->description !!}</textarea>
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
                                    <textarea name="features" class="form-control " id="editor1" >{!! $product->features !!}</textarea>
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
                                {{-- <input type="button" value="{{ trans('lang.save') }}" id="submit-btn" class="btn btn-primary"> --}}
                                {{-- <input type="submit" value="{{ trans('lang.submit') }}"  class="btn btn-primary"> --}}
                                <button type="submit" class="btn btn-primary px-5"><i class="icon-lock"></i> Update</button>
                            </div>
                        </div>
                    </div>
                    <div id="cropped_images"></div>
                </form><!-- end of form -->
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
    @include('admin.products.model-crop')
    {{-- <div class="modal fade" id="imagesModal" tabindex="-1" role="dialog" aria-labelledby="imagesModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagesModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="croppie-modal" style="display:none">
                        <div id="croppie-container"></div>
                        <button data-dismiss="modal" id="croppie-cancel-btn" type="button"
                                class="btn btn-secondary"><i
                                class="fas fa-times"></i></button>
                        <button id="croppie-submit-btn" type="button" class="btn btn-primary"><i
                                class="fas fa-crop"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}
@endsection
@push('js')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.config.language = "{{ app()->getLocale() }}";
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor1');
</script>

{{-- images crop js --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    <script>
        $("#sub-button-form").click(function (e){
            e.preventDefault();
            getImages()
            setTimeout(()=>{
                $("#form_row").submit();
            },500)
        });
        const fileInputImages = document.querySelector('#file-input-images');
        const previewImagesContainer = document.querySelector('.preview-images-container');
        const croppieModal = document.querySelector('#croppie-modal');
        const croppieContainer = document.querySelector('#croppie-container');
        const croppieCancelBtn = document.querySelector('#croppie-cancel-btn');
        const croppieSubmitBtn = document.querySelector('#croppie-submit-btn');
        fileInputImages.addEventListener('change', () => {
            let files = Array.from(fileInputImages.files)
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let fileType = file.type.slice(file.type.indexOf('/') + 1);
                let FileAccept = ["jpg","JPG","jpeg","JPEG","png","PNG","BMP","bmp"];
                // if (file.type.match('image.*')) {
                if (FileAccept.includes(fileType)) {
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const preview = document.createElement('div');
                        preview.classList.add('preview');
                        const img = document.createElement('img');
                        const actions = document.createElement('div');
                        actions.classList.add('action_div');
                        img.src = reader.result;
                        preview.appendChild(img);
                        preview.appendChild(actions);

                        const container = document.createElement('div');
                        const deleteBtn = document.createElement('span');
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                        deleteBtn.addEventListener('click', () => {
                            // if (window.confirm('Are you sure you want to delete this image?')) {
                            //     files.splice(file, 1)
                            //     preview.remove();
                            //     getImages()
                            // }
                            Swal.fire({
                                title: '{{ __("site.Are you sure?") }}',
                                text: "{{ __("site.You won't be able to delete!") }}",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        '{{ __("site.Your Image has been deleted.") }}',
                                        'success'
                                    )
                                    files.splice(file, 1)
                                    preview.remove();
                                    getImages()
                                }
                            });
                        });

                        preview.appendChild(deleteBtn);
                        const cropBtn = document.createElement('span');
                        cropBtn.setAttribute("data-toggle", "modal")
                        cropBtn.setAttribute("data-target", "#imagesModal")
                        cropBtn.classList.add('crop-btn');
                        cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                        cropBtn.addEventListener('click', () => {
                            setTimeout(() => {
                                launchImagesCropTool(img);
                            }, 500);
                        });
                        preview.appendChild(cropBtn);
                        previewImagesContainer.appendChild(preview);
                    });
                    reader.readAsDataURL(file);
                } else{
                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("site.Oops...") }}',
                        text: '{{ __("site.Sorry , You Should Upload Valid Image") }}',
                    })
                }
            }
            getImages()
        });
        function launchImagesCropTool(img) {
            // Set up Croppie options
            const croppieOptions = {
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square' // or 'square'
                },
                boundary: {
                    width: 300,
                    height: 300,
                },
                enableOrientation: true
            };

            // Create a new Croppie instance with the selected image and options
            const croppie = new Croppie(croppieContainer, croppieOptions);
            croppie.bind({
                url: img.src,
                orientation: 1,
            });

            // Show the Croppie modal
            croppieModal.style.display = 'block';

            // When the user clicks the "Cancel" button, hide the modal
            croppieCancelBtn.addEventListener('click', () => {
                croppieModal.style.display = 'none';
                $('#imagesModal').modal('hide');
                croppie.destroy();
            });

            // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
            croppieSubmitBtn.addEventListener('click', () => {
                croppie.result({
                    type: 'canvas',
                    size: {
                        width: 800,
                        height: 600
                    },
                    quality: 1 // Set quality to 1 for maximum quality
                }).then((croppedImg) => {
                    img.src = croppedImg;
                    croppieModal.style.display = 'none';
                    $('#imagesModal').modal('hide');
                    croppie.destroy();
                });
            });
        }

        // edit Case
        $('.cropBtn_c').click(function() {
            index=$(this).data('id');
            setTimeout(() => {
                launchImagesCropTool(document.getElementById("img_c"+index));
            }, 500);

        });
       $('.deleteBtn_c').click(function() {


            index=$(this).data('id');
            Swal.fire({
                title: '{{ __("site.Are you sure?") }}',
                text: "{{ __("site.You won't be able to delete!") }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        '{{ __("site.Your Image has been deleted.") }}',
                        'success'
                    )
                    $("#preview_c"+index).remove();
                }
            });
        });
        @if($product->image()->count() > 0)
        @foreach($product->image as $index=>$media)
        document.getElementById("cropBtn{{ $index + 1 }}").addEventListener('click', () => {
            console.log(("#imagesModal"))
            setTimeout(() => {
                launchImagesCropTool(document.getElementById("img{{ $index + 1 }}"));
            }, 500);
        });
        document.getElementById("deleteBtn{{ $index + 1 }}").addEventListener('click', () => {
            {{--if (window.confirm('Are you sure you want to delete this image?')) {--}}
            {{--    $("#preview{{ $index + 1 }}").remove();--}}
            {{--}--}}
            Swal.fire({
                title: '{{ __("site.Are you sure?") }}',
                text: "{{ __("site.You won't be able to delete!") }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        '{{ __("site.Your Image has been deleted.") }}',
                        'success'
                    )
                    $("#preview{{ $index +1 }}").remove();
                }
            });
        });
        @endforeach
        @endif
        function getImages() {
            $("#cropped_images").empty();
            setTimeout(() => {
                const container = document.querySelectorAll('.preview-images-container');
                let images = [];
                for (let i = 0; i < container[0].children.length; i++) {
                    images.push(container[0].children[i].children[0].src)
                    var newInput = $("<input>").attr("type", "hidden").attr("name", "cropImages[]").val(container[0].children[i].children[0].src);
                    $("#cropped_images").append(newInput);
                }
                console.log(images)
                return images
            }, 300);
        }


    </script>

{{-- images crop js --}}
@endpush
{{--  --}}
