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
                            <input type="text" class="form-control" id="" wire:model.live="product_name">
                        </div>
                        @error('product_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- category -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.Category')<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select name="category_id" id="category_id" wire:model.live="category_id"
                                    class="form-control">
                                    <option value="">اختر القسم</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addCategoryModal">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addbrandModal">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @error('brand_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- color -->
                    <div class="col-md-3">
                        <div class="form-group" wire:ignore>
                            <label>@lang('products.color')<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select name="color_id[]" id="color_id" wire:model.defer="color_id"
                                    class="form-control select2 multiple" multiple>
                                    <option value="">اختر اللون</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addcolorModal">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @error('color_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- size -->
                    <div class="col-md-3" wire:ignore>
                    <div class="form-group">
                        <label>@lang('products.size')<span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center gap-2">
                            <select name="size_id[]" id="size_id" wire:model="size_id"
                                class="form-control select2 multiple" multiple>
                                <option value="">اختر مقاس</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#addsizeModal">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    @error('size_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                </div>
                <!-- <div class="row"> -->
                   <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('products.description')</label>
                            <textarea id="description" wire:model.live="description" class="ckeditor form-control"></textarea>
                        </div>
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    
            </div>
        </div>
    </div>                
                    <div class="col-md-12 mt-3">
                        <div class="form-group text-center">
                            <button type="button" class="btn btn-success" wire:click="submit">
                                @lang('site.save')
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            @push('js')
              <!-- Select2 Script -->
<script>
    $(document).ready(function () {
        $('#color_id').select2({
            placeholder: "اختر اللون",
            allowClear: true,
            multiple: true
        }).on('change', function () {
            let selectedColors = $(this).val();
            Livewire.emit('colorUpdated', selectedColors);
        });

        $('#size_id').select2({
            placeholder: "اختر مقاس",
            allowClear: true,
            multiple: true
        }).on('change', function () {
            let selectedSizes = $(this).val();
            Livewire.emit('sizeUpdated', selectedSizes);
        });

        // CKEditor Initialization
        ClassicEditor.create(document.querySelector('#description'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    Livewire.emit('descriptionUpdated', editor.getData());
                });
            })
            .catch(error => {
                console.error(error);
            });
    });

    // لإعادة تهيئة Select2 بعد إعادة تحميل Livewire
    document.addEventListener('livewire:load', function () {
        Livewire.hook('message.processed', (message, component) => {
            $('#color_id').select2();
            $('#size_id').select2();
        });
    });
</script>
            @endpush

        </div>
    </div>
</div>
