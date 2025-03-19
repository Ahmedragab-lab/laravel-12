<div>
    @if($screen =='index')
    <x-messages></x-messages>
        <div class="row">
            <div class="col-md-12">
                <div class="tile shadow">
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" wire:click="$set('screen','create')">
                                اضافه منتج جديد
                                <i class="fa fa-plus"></i>
                            </button>
                            {{-- <a wire:click="$set('screen','create')" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a> --}}
                        </div>
                        <div class="col-md-1">
                            <select  class="form-control" wire:model.live='perPage'>
                                <option value="">---</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        {{-- <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" id="data-table-search" class="form-control" autofocus
                                    placeholder="اسم البرند" wire:model.live='search'>
                            </div>
                        </div> --}}

                    </div><!-- end of row -->
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="data-table-search" class="form-control" autofocus placeholder="@lang('site.search')">
                            </div>
                        </div>
                    </div><!-- end of row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table  datatable data-table table-striped table-bordered table-sm" id="products-table" >
                                    <thead>
                                        <tr>
                                            <th>
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
                                            <th>@lang('site.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($products as $index=>$product)
                                            <tr>
                                                <td>
                                                    <div class="animated-checkbox">
                                                        <label class="m-0">
                                                            <input type="checkbox" value="{{ $product->id }}" name="selected_ids[]" class="selected_ids">
                                                            <span class="label-text"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>{{ $index +1 }}</td>
                                                <td>
                                                    <img src="{{ $product->image ? display_file($product->image) : asset('no-image.jpg') }}" alt="{{ $product->name }}" width="50">
                                                </td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->category?->name }}</td>
                                                <td>{{ Number::currency($product->price,'EGP') }}</td>
                                                <td>{{ $product->brand?->name }}</td>
                                                <td>
                                                    @foreach ($product->color as $color)
                                                        <span class=" badge  badge-primary mb-2" style="width: 50px;height: 20px;font-size: 12px;">
                                                            {{$color->name}}
                                                        </span>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @foreach ($product->size as $size)
                                                        <span class=" badge badge-pill badge-warning mb-2" style="width: 30px;height: 20px;font-size: 12px;">
                                                            {{ $size->name }}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td>{{ $product->admin?->name }}</td>
                                                <td>{{ $product->status == 1 ? 'متاح' : 'غير متاح' }}</td>
                                                <td>{{ $product->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-info" wire:click='edit({{ $product->id }})'>
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-warning" wire:click='show({{ $product->id }})'>
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-dark btn-sm " data-toggle="modal"
                                                            data-target="#showbarcode{{ $product->id }}" title="@lang('products.barcode')">
                                                        <i class="fa fa-vcard"></i>
                                                    </button>
                                                    <div class="modal fade" id="showbarcode{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">{{ $product->product_name }}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{ $product->product_name }}
                                                                    {!! DNS1D::getBarcodeHTML($product->code . '', 'C128') !!}
                                                                    {{ $product->created_at->format('Y-m-d') }}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                                    {{-- <button type="submit" class="btn btn-primary">نعم</button> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-delete-modal :item="$product" />
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="12">لا يوجد منتجات</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $products->links() }}
                            </div><!-- end of table responsive -->
                        </div><!-- end of col -->
                    </div><!-- end of row -->
                </div><!-- end of tile -->
            </div><!-- end of col -->
        </div><!-- end of row -->
    @elseif($screen =='create')
    @include('admin.products2.createOrUpdate')
    @elseif($screen =='edit')
    @include('admin.products2.createOrUpdate')
    @elseif($screen =='show')
        <h1>hi show</h1>
    @endif
    @push('js')
    <script>
        console.log('hello');
        document.addEventListener('livewire:initialized', () => {
            initSelect2();
            Livewire.hook('morph.updated', ({ el }) => {
                initSelect2();
            });
        });

        function initSelect2() {
            $('.select2.multiple').select2({
                placeholder: "اختر ",
                allowClear: true,
                multiple: true // Enable multi-select
            }).on('change', function (e) {
                const data = $(this).select2("val");
                if('color_id'){
                    @this.set('color_id', data);
                }else if('size_id'){
                    @this.set('size_id', data);
                }
            });

            if (fieldId === 'color_id' && @this.get('color_id')) {
                $(this).val(@this.get('color_id')).trigger('change');
            } else if (fieldId === 'size_id' && @this.get('size_id')) {
                $(this).val(@this.get('size_id')).trigger('change');
            }
        }

    </script>
    {{-- <script>
        document.addEventListener('livewire:initialized', () => {
            initSelect2();

            // Listen for a custom event to refresh Select2
            Livewire.on('refreshSelect2', () => {
                initSelect2();
            });

            Livewire.hook('morph.updated', ({ el }) => {
                initSelect2();
            });
        });

        function initSelect2() {
            $('.select2.multiple').each(function() {
                let fieldId = $(this).attr('id');

                $(this).select2({
                    placeholder: "اختر ",
                    allowClear: true,
                    multiple: true
                }).on('change', function (e) {
                    const data = $(this).select2("val");

                    // Send the selected values to Livewire
                    if (fieldId === 'color_id') {
                        @this.set('color_id', data);
                    } else if (fieldId === 'size_id') {
                        @this.set('size_id', data);
                    }
                });

                // This is important - after initializing Select2, update its value from Livewire component
                if (fieldId === 'color_id' && @this.get('color_id')) {
                    $(this).val(@this.get('color_id')).trigger('change');
                } else if (fieldId === 'size_id' && @this.get('size_id')) {
                    $(this).val(@this.get('size_id')).trigger('change');
                }
            });
        }
    </script> --}}
    @endpush
</div>
