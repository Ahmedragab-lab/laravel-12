<div>
    {{-- @if ($screen == 'index') --}}
        <x-messages></x-messages>
        <div class="row">
            <div class="col-md-12">
                <div class="tile shadow">
                    <div class="row mb-2">
                        {{-- <p>test product by livewire</p> --}}
                        <div class="col-md-1">
                            <a href="{{ route('products2.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i> @lang('site.create')</a>
                        </div>
                        <div class="col-md-1">
                            <select class="form-control" wire:model.live='perPage'>
                                <option value="">---</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" id="data-table-search" class="form-control" autofocus
                                    placeholder="اسم المنتج" wire:model.live='search'>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" id="data-table-search" class="form-control" autofocus
                                    placeholder="اسم البراند" wire:model.live='search_brand'>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" id="data-table-search" class="form-control" autofocus
                                    placeholder="اسم القسم" wire:model.live='search_category'>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select name="" id="" class="form-control" wire:model.live='search_admin' id="">
                                    <option value="">المسؤل</option>
                                    @foreach ($admins as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select name="" id="" class="form-control" wire:model.live='search_brand_id' id="">
                                    <option value="">البراند</option>
                                    @foreach (App\Models\Brand::all() as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <button class="btn btn-warning btn-sm" wire:click="$set('filter', '')">الكل {{ \App\Models\Product::count() }}</button>
                                <button class="btn btn-primary btn-sm" wire:click="$set('filter', 'active')">المفعلين {{ $active }}</button>
                                <button class="btn btn-danger btn-sm"  wire:click="$set('filter', 'unactive')">غير مفعلين {{ $unactive }}</button>
                                <button class="btn btn-warning btn-sm" id="btn-prt-content">
                                    <i class="fa fa-print"></i>
                                </button>
                                <button wire:click="resetFilters" class="btn btn-dark btn-sm">
                                    <i class="fa fa-filter"></i></button>
                            </div>
                        </div>

                    </div>
                    <div class="row" id="prt-content">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table  datatable data-table table-striped table-bordered table-sm"
                                    id="products-table">
                                    <thead>
                                        <tr>
                                            <th class="not-print">
                                                <div class="animated-checkbox">
                                                    <label class="m-0">
                                                        <input type="checkbox" name="select_all" id="select-all">
                                                        <span class="label-text"></span>
                                                    </label>
                                                </div>
                                            </th>
                                            <th>#</th>
                                            <th>صوره االمنتج </th>
                                            <th>الاسم</th>
                                            <th>
                                                <span class=" badge  badge-warning mb-2">القسم</span>
                                            </th>
                                            <th>السعر</th>
                                            <th>براند</th>
                                            <th>الالوان</th>
                                            <th>المقاسات</th>
                                            <th>المسؤال</th>
                                            <th>الحاله</th>
                                            <th>تاريخ انشاء</th>
                                            <th class="not-print">@lang('site.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($products as $index=>$product)
                                            <tr>
                                                <td class="not-print">
                                                    <div class="animated-checkbox">
                                                        <label class="m-0">
                                                            <input type="checkbox" value="{{ $product->id }}"
                                                                name="selected_ids[]" class="selected_ids">
                                                            <span class="label-text"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <img src="{{ $product->image ? display_file($product->image) : asset('no-image.jpg') }}"
                                                        alt="{{ $product->name }}" width="50">
                                                </td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->category?->name }}</td>
                                                <td>{{ Number::currency($product->price, 'EGP') }}</td>
                                                <td>{{ $product->brand?->name }}</td>
                                                <td>
                                                    @foreach ($product->color as $color)
                                                        <span class=" badge  badge-primary mb-2"
                                                            style="width: 50px;height: 20px;font-size: 12px;">
                                                            {{ $color->name }}
                                                        </span>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @foreach ($product->size as $size)
                                                        <span class=" badge badge-pill badge-warning mb-2"
                                                            style="width: 30px;height: 20px;font-size: 12px;">
                                                            {{ $size->name }}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td>{{ $product->admin?->name }}</td>
                                                <td>
                                                    <span class="badge badge-pill {{ $product->status == 1 ? 'badge-primary' : 'badge-danger' }} mb-2"
                                                        style="margin-top: 15px">

                                                        {{ $product->status == 1 ? 'مفعل' : 'غير مفعل' }}</td>
                                                    </span>
                                                <td>{{ $product->created_at->format('Y-m-d') }}</td>
                                                <td class="not-print">
                                                    <a href="{{ route('products2.update', $product->id ) }}" class="btn btn-sm btn-info">
                                                        <i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-sm btn-warning"
                                                        wire:click='show({{ $product->id }})'>
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    @include('livewire.admin.products2.barcode')
                                                    <x-delete-modal :item="$product" />
                                                </td>
                                            </tr>
                                        @empty
                                            <tr >
                                                <td colspan="12">لا يوجد منتجات</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="not-print">

                                    {{ $products->links() }}
                                </div>
                            </div><!-- end of table responsive -->
                        </div><!-- end of col -->
                    </div><!-- end of row -->
                </div><!-- end of tile -->
            </div><!-- end of col -->
        </div><!-- end of row -->
    {{-- @elseif($screen == 'create')
        @include('admin.products2.createOrUpdate')
    @elseif($screen == 'edit')
        @include('admin.products2.createOrUpdate')
    @elseif($screen == 'show')
        <h1>hi show</h1>
    @endif --}}
    {{-- @push('js')
        <!-- Load jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- Load Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

        <!-- Livewire Hooks -->
        <script>
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
    @endpush --}}
</div>
