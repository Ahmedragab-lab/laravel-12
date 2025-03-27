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
                           <div class="row">
                                <div class="col-md-10">
                                    <x-select2  wire:model="category_id" :options="$categories" option-label="name" option-value="id" />
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#addCategoryModal">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
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
                            <div class="row">
                                <div class="col-md-10">
                                    <x-select2  wire:model="brand_id" :options="$brands" option-label="name" option-value="id" />
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        {{-- <select name="brand_id" id="brand_id" wire:model.live="brand_id" class="form-control">
                                            <option value="">اختر البراند</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select> --}}
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#addbrandModal">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('brand_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- color -->
                    <div class="col-md-3">
                        <div class="form-group" >
                            <label>@lang('products.color')<span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-md-10">
                                    <x-select2  wire:model.live="color_ids" multiple :options="$colors" option-label="name" option-value="id" />
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        {{-- <select  id="color_id" wire:model.defer="color_ids"
                                            class="form-control select2 multiple" multiple>
                                            <option value="">اختر اللون</option>
                                            @foreach ($colors as $color)
                                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                            @endforeach
                                        </select> --}}
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#addcolorModal">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('color_ids')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- size -->
                    <div class="col-md-3" wire:ignore>
                        <div class="form-group">
                            <label>@lang('products.size')<span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-md-10">
                                    <x-select2  wire:model="size_ids" multiple :options="$sizes" option-label="name" option-value="id" />
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group" >
                                        {{-- <select  id="size_id" wire:model="size_ids"
                                            class="form-control select2 multiple" multiple>
                                            <option value="">اختر مقاس</option>
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                                            @endforeach
                                        </select> --}}
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#addsizeModal">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @error('size_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.expiration_date')<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" wire:model="expiration_date">
                        </div>
                        @error('expiration_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Price Field -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.price')<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" wire:model="price" step="1" min="0"
                                placeholder="Enter price">
                        </div>
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- discount Field -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.discount')<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" wire:model="discount" step="1"
                                min="0" placeholder="Enter discount">
                        </div>
                        @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- stock Field -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.stock')<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" wire:model="stock" step="1"
                                min="0" placeholder="Enter stock">
                        </div>
                        @error('stock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Image Selector Field -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>@lang('products.image')<span class="text-danger">*</span></label>
                            <input type="file" class="form-control" wire:model="image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Image Preview -->
                        <div class="mt-2">
                            @if ($image instanceof \Illuminate\Http\UploadedFile)
                                <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" width="100" />
                            @elseif (is_string($image) && !empty($image))
                                <img src="{{ display_file($image) }}" class="img-thumbnail" width="100" />
                            @else
                                <img src="{{ asset('no-image.jpg') }}" class="img-thumbnail" width="100" />
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="inp-holder" wire:ignore>
                            <label for="">الوصف</label>
                            {{-- <textarea wire:model.live="description" class="ckeditor form-control" cols="30" rows="10"  ></textarea> --}}
                            <textarea wire:model.live="description" class=" form-control" cols="30" rows="10">
                                {{ old('description', $description ?? '') }}
                            </textarea>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="inp-holder">
                            <label>المرفقات</label>
                            <input type="file" multiple class="form-control" wire:model.live="products_images" accept="image/*">
                        </div>

                        @if ($products_images && count($products_images) > 0)
                            @foreach ($products_images as $key => $attachment)
                                <div class="d-inline-block me-2 mb-2">
                                    <div class="position-relative">
                                        @if (is_array($attachment) && isset($attachment['file_name']))
                                            <img src="{{ display_file('products_images/' . $attachment['file_name']) }}"
                                            class="img-thumbnail" width="100" />
                                        @elseif ($attachment instanceof \Illuminate\Http\UploadedFile)
                                            <img src="{{ $attachment->temporaryUrl() }}" class="img-thumbnail" width="100" />
                                        @else
                                            <img src="{{ asset('no-image.jpg') }}" class="img-thumbnail" width="100" />
                                        @endif
                                        <button type="button"
                                                class="btn btn-sm btn-danger position-absolute"
                                                style="top: 5px; right: 5px;"
                                                wire:click="removeAttachment({{ $key }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>




                </div>
                @include('admin.products2.__addCategoryModal')
                @include('admin.products2.__addBrandModal')
                @include('admin.products2.__addColorModal')
                @include('admin.products2.__addSizeModal')

                <div class="col-md-12 mt-3">
                    <div class="form-group text-center">
                        {{-- <button type="button" class="btn btn-success" wire:click="submit">
                            @lang('site.save')
                        </button> --}}
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-success" wire:click="submit">
                            <span wire:loading.remove> @lang('site.save')</span>
                            <span wire:loading>Processing...</span>
                        </button>
                    </div>
                </div>


                <!-- end of tile -->
            </div><!-- end of col -->
        </div><!-- end of row -->
        <!-- Save Button -->


        @push('js')
            <!-- Load jQuery -->
            {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

            <!-- Load Select2 -->
            <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    initSelect2();
                });

                document.addEventListener("livewire:init", () => {
                    Livewire.on('refreshSelect2', () => {
                        console.log('Refreshing Select2');
                        refreshSelect2();
                    });
                });

                function initSelect2() {
                    if (!$.fn.select2) {
                        console.error("Select2 is not loaded.");
                        return;
                    }

                    $('#color_id').select2({
                        placeholder: "اختر اللون",
                        allowClear: true,
                        multiple: true
                    }).on('change', function() {
                        let selectedColors = $(this).val();
                        Livewire.dispatch('colorUpdated', { color_ids: selectedColors });
                    });

                    $('#size_id').select2({
                        placeholder: "اختر مقاس",
                        allowClear: true,
                        multiple: true
                    }).on('change', function() {
                        let selectedSizes = $(this).val();
                        Livewire.dispatch('sizeUpdated', { size_ids: selectedSizes });
                    });

                    console.log("Select2 initialized successfully!");
                }

                function refreshSelect2() {
                    $('#color_id').select2('destroy').select2({
                        placeholder: "اختر اللون",
                        allowClear: true,
                        multiple: true
                    }).trigger('change');

                    $('#size_id').select2('destroy').select2({
                        placeholder: "اختر مقاس",
                        allowClear: true,
                        multiple: true
                    }).trigger('change');
                }

            </script> --}}
            {{-- <script>
                document.addEventListener("DOMContentLoaded", function() {
                    console.log("DOM fully loaded - Initializing Select2");

                    initSelect2();
                });

                document.addEventListener("livewire:navigated", function() {
                    console.log("Livewire component updated - Reinitializing Select2");

                    initSelect2();
                });

                // Listen for refresh event to reinitialize Select2
                Livewire.on('refreshSelect2', function() {
                    console.log("Received refreshSelect2 event - Reinitializing Select2");
                    initSelect2();
                });

                function initSelect2() {
                    if (!$.fn.select2) {
                        console.error("Select2 is not loaded.");
                        return;
                    }

                    $('#color_id').select2({
                        placeholder: "اختر اللون",
                        allowClear: true,
                        multiple: true
                    }).on('change', function() {
                        let selectedColors = $(this).val();
                        Livewire.dispatch('colorUpdated', {
                            color_id: selectedColors
                        });
                    });

                    $('#size_id').select2({
                        placeholder: "اختر مقاس",
                        allowClear: true,
                        multiple: true
                    }).on('change', function() {
                        let selectedSizes = $(this).val();
                        Livewire.dispatch('sizeUpdated', {
                            size_id: selectedSizes
                        });
                    });

                    console.log("Select2 initialized successfully!");
                }
            </script> --}}
            {{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    initializeCKEditor();
                });

                document.addEventListener("livewire:navigated", function () {
                    initializeCKEditor();
                });

                Livewire.on('refreshEditor', function () {
                    initializeCKEditor();
                });

                function initializeCKEditor() {
                    let editorElement = document.querySelector('.ckeditor');

                    if (!editorElement) {
                        console.error("CKEditor element not found.");
                        return;
                    }

                    if (editorElement.ckeditorInstance) {
                        editorElement.ckeditorInstance.destroy().then(() => {
                            createCKEditor(editorElement);
                        }).catch(error => {
                            console.error("Error destroying CKEditor:", error);
                        });
                    } else {
                        createCKEditor(editorElement);
                    }
                }

                function createCKEditor(element) {
                    ClassicEditor
                        .create(element, {
                            toolbar: {
                                items: [
                                    'undo', 'redo',
                                    '|', 'heading',
                                    '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                                    '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                                    '|', 'link', 'uploadImage', 'blockQuote', 'codeBlock',
                                    '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                                ],
                                shouldNotGroupWhenFull: false
                            }
                        })
                        .then(editor => {
                            element.ckeditorInstance = editor;

                            // Set initial value from Livewire
                            let description = @json($description);
                            if (description) {
                                editor.setData(description);
                            }

                            let debounceTimer;
                            editor.model.document.on('change:data', () => {
                                clearTimeout(debounceTimer);
                                debounceTimer = setTimeout(() => {
                                    Livewire.dispatch('editorUpdated', { description: editor.getData() });
                                }, 300);
                            });

                            console.log("CKEditor initialized successfully");
                        })
                        .catch(error => {
                            console.error("CKEditor initialization error:", error);
                        });
                }
            </script> --}}
        @endpush
    </div>
</div>

