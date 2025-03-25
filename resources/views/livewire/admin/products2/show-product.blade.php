<div>
    <x-messages></x-messages>
    <div>
        <h2>{{ $product->product_name }}</h2>
        <h4>{!! DNS1D::getBarcodeHTML($product->code . '', 'C128') !!}</h4>

        <a href="{{ route('products2') }}" class="btn btn-sm btn-primary">back</a>
        <button class="btn btn-warning btn-sm" id="btn-prt-content">
            <i class="fa fa-print"></i>
        </button>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products2') }}">@lang('products.products')</a></li>
        <li class="breadcrumb-item">@lang('site.show')</li>
    </ul>
    <div class="row" id="prt-content">
        <div class="col-md-12">
            <div class="tile shadow">
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <img src="{{ $product->image ? display_file($product->image) : asset('no-image.jpg') }}"
                            class="img-thumbnail" width="200" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.name')</label>
                            <input type="text" class="form-control" id="" value="{{ $product->product_name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>القسم</label>
                            <input type="text" class="form-control" id="" value="{{ $product->category?->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>البرند</label>
                            <input type="text" class="form-control" id="" value="{{ $product->brand?->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.color')</label>
                            <input type="text" class="form-control"
                                   value="{{ $product->color->count() > 0 ? $product->color->pluck('name')->implode(', ') : '' }}"
                                   disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.size')</label>
                            <input type="text" class="form-control"
                                   value="{{ $product->size->count() > 0 ? $product->size->pluck('name')->implode(', ') : '' }}"
                                   disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.expiration_date')</label>
                            <input type="text" class="form-control"
                                   value="{{ $product->expiration_date }}"
                                   disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.price')</label>
                            <input type="text" class="form-control"
                                   value="{{ Number::currency($product->price, 'EGP') }}"
                                   disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.discount')</label>
                            <input type="text" class="form-control"
                                   value="{{ Number::currency($product->discount, 'EGP') }}"
                                   disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.stock')</label>
                            <input type="text" class="form-control"
                                   value="{{ $product->stock }}"
                                   disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.status')</label>
                            <input type="text" class="form-control"
                                   value="{{ $product->status == 1 ? 'متوفر' : 'غير متوفر' }}"
                                   disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="inp-holder">
                            <label for="">الباركود</label>
                            {!! DNS1D::getBarcodeHTML($product->code . '', 'C128') !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="inp-holder">
                            <label for="">الوصف</label>
                            <p>{!! $product->description !!}</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">المرفقات</label>
                        <div class="inp-holder">
                            @if ($product->images)
                                @foreach ($product->images as $key => $attachment)
                                <img src="{{ $attachment ? display_file('products_images/' . $attachment->file_name) : asset('no-image.jpg') }}"
                                class="img-thumbnail" width="200" />
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div> --}}

                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('products.name')</label>
                                    <input type="text" class="form-control" id="" value="{{ $product->product_name }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>القسم</label>
                                    <input type="text" class="form-control" id="" value="{{ $product->category?->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>البرند</label>
                                    <input type="text" class="form-control" id="" value="{{ $product->brand?->name }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('products.expiration_date')</label>
                                    <input type="text" class="form-control"
                                           value="{{ $product->expiration_date }}"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('products.price')</label>
                                    <input type="text" class="form-control"
                                           value="{{ Number::currency($product->price, 'EGP') }}"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('products.discount')</label>
                                    <input type="text" class="form-control"
                                           value="{{ Number::currency($product->discount, 'EGP') }}"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('products.stock')</label>
                                    <input type="text" class="form-control"
                                           value="{{ $product->stock }}"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('products.status')</label>
                                    <input type="text" class="form-control"
                                           value="{{ $product->status == 1 ? 'متوفر' : 'غير متوفر' }}"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>الوان المنتج</label>
                                    <input type="text" class="form-control"
                                           value="{{ $product->color->count() > 0 ? $product->color->pluck('name')->implode(', ') : '' }}"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>مقاسات المنتج</label>
                                    <input type="text" class="form-control"
                                           value="{{ $product->size->count() > 0 ? $product->size->pluck('name')->implode(', ') : '' }}"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="inp-holder">
                                    <label for="">الباركود</label>
                                    {!! DNS1D::getBarcodeHTML($product->code . '', 'C128') !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="inp-holder">
                                    <label for="">الوصف</label>
                                    <p>{!! $product->description !!}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <img src="{{ $product->image ? display_file($product->image) : asset('no-image.jpg') }}"
                            class="img-thumbnail" width="500" height="1000" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="">المرفقات</label>
                                <div class="inp-holder">
                                    @if ($product->images)
                                        @foreach ($product->images as $key => $attachment)
                                        <img src="{{ $attachment ? display_file('products_images/' . $attachment->file_name) : asset('no-image.jpg') }}"
                                        class="img-thumbnail" width="200" />
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

