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
                                    <option value="">اختر القسم</option>
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
                                <select name="color_id[]" id="color_id" wire:model.live="color_id" class="form-control select2 multiple" multiple>
                                    <option value="">اختر اللون</option>
                                    @foreach ($colors as $color)
                                        <option
                                         value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcolorModal">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        @error('color_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <!-- size -->
                    <div class="col-md-3" >
                        <div class="form-group">
                            <label>@lang('products.size')<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select name="size_id[]" id="size_id" wire:model="size_id" class="form-control select2 multiple" multiple >
                                    <option value="">اختر مقاس</option>
                                    @foreach ($sizes as $size)
                                        <option
                                         value="{{ $size->id }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addsizeModal">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        @error('size_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.expiration_date')<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" wire:model="expiration_date">
                        </div>
                        @error('expiration_date')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <!-- Price Field -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.price')<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" wire:model="price" step="1" min="0" placeholder="Enter price">
                        </div>
                        @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                   <!-- discount Field -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.discount')<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" wire:model="discount" step="1" min="0" placeholder="Enter discount">
                        </div>
                        @error('discount')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <!-- stock Field -->
                   <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.stock')<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" wire:model="stock" step="1" min="0" placeholder="Enter stock">
                        </div>
                        @error('stock')<span class="text-danger">{{ $message }}</span>@enderror
                   </div>
                    <!-- Status Field -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.status')<span class="text-danger">*</span></label>
                            <select name="status" class="form-control" wire:model="status">
                                <option value="0">Off</option>
                                <option value="1">On</option>
                            </select>
                        </div>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                  <!-- Image Selector Field -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.image')<span class="text-danger">*</span></label>
                            <input type="file" class="form-control" wire:model="image">
                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <!-- Image Preview -->
                        @if ($image)
                            <div class="mt-2">
                                <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="img-thumbnail" width="150">
                            </div>
                        @endif
                    </div>

                    <div class="col-md-12">
                        <div class="inp-holder" wire:ignore>
                            <label for="">الوصف</label>
                            <textarea wire:model="description" class="ckeditor form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="inp-holder">
                            <label>المرفقات</label>
                            <input type="file" multiple class="form-control" wire:model.live="products_images">
                        </div>
                        {{-- {{ $obj }} --}}
                        @if ($products_images)
                            @foreach ($products_images as $key =>$attachment)
                                <x-file-preview :file="$attachment" :key="$key"/>
                            @endforeach
                        @endif
                    </div>




                   </div>
                   @include('admin.products2.__addCategoryModal')
                    @include('admin.products2.__addBrandModal')
                    @include('admin.products2.__addColorModal')
                    @include('admin.products2.__addSizeModal')




          <!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
    <!-- Save Button -->
<div class="col-md-12 mt-3">
    <div class="form-group text-center">
        <button type="button" class="btn btn-success" wire:click="submit">
            @lang('site.save')
        </button>
    </div>
</div>
</div>

