<div>
    <x-messages></x-messages>
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
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.name')<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="" wire:model.live="product_name">{{ $product_name }}
                        </div>
                        @error('product_name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                   <!-- category -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.Category')<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select name="category_id" id="category_id" wire:model.live="category_id" class="form-control">
                                    <option value="">اختر البراند</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <!--brand  -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.brand')<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select name="brand_id" id="brand_id" wire:model.live="brand_id" class="form-control">
                                    <option value="">اختر البراند</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addbrandModal">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @error('brand_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <!-- color -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.color')<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select name="color_id" id="color_id" wire:model.live="color_id" class="form-control">
                                    <option value="">اختر اللون</option>
                                    @foreach ($colors as $color)
                                        <option
                                         value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcolorModal">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @error('color_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <!-- size -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.size')<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select name="size_id" id="size_id" wire:model="size_id" class="form-control">
                                    <option value="">اختر مقاس</option>
                                    @foreach ($sizes as $size)
                                        <option
                                         value="{{ $size->id }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addsizeModal">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @error('size_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    @include('admin.products2.__addCategoryModal')
                    @include('admin.products2.__addBrandModal')
                    @include('admin.products2.__addColorModal')
                    @include('admin.products2.__addSizeModal')
                </div>
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
    <!-- Save Button -->
<div class="col-md-12 mt-3">
    <div class="form-group text-center">
        <button type="button" class="btn btn-success" wire:click="saveProduct">
            @lang('site.save')
        </button>
    </div>
</div>
</div>
<script>
    Livewire.on('categoryAdded', () => {
        // If you're using Select2 or similar, re-initialize it here
    });

</script>
@push('js')
@endpush
