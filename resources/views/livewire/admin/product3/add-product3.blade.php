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
                </div>
                <!-- <div class="row"> -->
                <div class="col-md-12">
                        <div class="inp-holder" wire:ignore>
                            <label for="">الوصف</label>
                            <textarea wire:model.live="description" class="ckeditor form-control" rows="3"></textarea>
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
                    @include('admin.products2.__addCategoryModal')
                    @include('admin.products2.__addBrandModal')
                    @include('admin.products2.__addColorModal')
                    @include('admin.products2.__addSizeModal')
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

    // لإعادة تهيئة Select2 بعد إعادة تحميل Livewire
    document.addEventListener('livewire:load', function () {
        Livewire.hook('message.processed', (message, component) => {
            $('#color_id').select2();
            $('#size_id').select2();
        });
    });
});
</script>
<script>
        function initializeCKEditor() {
            const editorElement = document.querySelector('#description');
            if (editorElement && !editorElement.classList.contains('ck-editor-loaded')) {
                ClassicEditor.create(editorElement)
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            Livewire.emit('descriptionUpdated', editor.getData());
                        });
                        editorElement.classList.add('ck-editor-loaded'); // Prevents reinitialization
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }

        document.addEventListener('livewire:load', () => {
            initializeCKEditor();

            Livewire.hook('message.processed', (message, component) => {
                initializeCKEditor(); // Reinitialize CKEditor every time Livewire updates the DOM
            });

            $('#color_id').select2().on('change', function () {
                Livewire.emit('colorUpdated', $(this).val());
            });

            $('#size_id').select2().on('change', function () {
                Livewire.emit('sizeUpdated', $(this).val());
            });
        });
    </script>
       <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
          <script>
              document.addEventListener("DOMContentLoaded", function () {
                  console.log("DOM fully loaded - Initializing CKEditor");
                  initializeCKEditor();
              });

              document.addEventListener("livewire:navigated", function () {
                  console.log("Livewire component updated - Reinitializing CKEditor");
                  initializeCKEditor();
              });

              Livewire.on('refreshEditor', function () {
                  console.log("Received refreshEditor event - Reinitializing CKEditor");
                  initializeCKEditor();
              });

              function initializeCKEditor() {
                  let editorElement = document.querySelector('.ckeditor');

                  if (!editorElement) {
                      console.error("CKEditor element not found.");
                      return;
                  }

                  // Destroy existing editor instance if present
                  if (editorElement.ckeditorInstance) {
                      console.log("Destroying existing CKEditor instance...");
                      editorElement.ckeditorInstance.destroy().then(() => {
                          console.log("CKEditor destroyed.");
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
                          console.log("CKEditor initialized successfully");
                          element.ckeditorInstance = editor;

                          // Sync CKEditor content with Livewire
                          let debounceTimer;
                          editor.model.document.on('change:data', () => {
                              clearTimeout(debounceTimer);
                              debounceTimer = setTimeout(() => {
                                  const content = editor.getData();
                                  console.log('Editor content changed:', content);
                                  Livewire.dispatch('editorUpdated', { content: content });
                              }, 300);
                          });
                      })
                      .catch(error => {
                          console.error("CKEditor initialization error:", error);
                      });
              }
          </script>

            @endpush

        </div>
    </div>
</div>
