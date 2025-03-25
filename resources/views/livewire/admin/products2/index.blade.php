<div>
    <x-messages></x-messages>
    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-1">
                        <a href="{{ route('products2.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> @lang('site.create')
                        </a>

                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger" id="btn_delete_all" data-toggle="modal"
                                data-target="#bulkdelete" {{ count($selected_ids) == 0 ? 'disabled' : '' }} >
                                <i class="fa fa-trash"></i>
                                @lang('site.bulk_delete')({{ count($selected_ids) }})
                        </button>
                        @include('livewire.admin.products2.__bulkDeleteModal')
                    </div>
                </div>
                <div class="row mb-2">
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
                </div>
                <div class="row mb-2">
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
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="" id="" class="form-control" wire:model.live='search_category_id' id="">
                                <option value="">القسم</option>
                                @foreach (App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="" id="" class="form-control" wire:model.live='search_color_id' id="">
                                <option value="">الالوان</option>
                                @foreach (App\Models\Color::all() as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="" id="" class="form-control" wire:model.live='search_size_id' id="">
                                <option value="">المقاسات</option>
                                @foreach (App\Models\Size::all() as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
                                                    <input type="checkbox" name="select_all" wire:model.live="selectAll" id="select-all">
                                                    <span class="label-text"></span>
                                                </label>
                                            </div>
                                        </th>
                                        <th>#</th>
                                        <th>صوره االمنتج </th>
                                        <th wire:click="setSortBy('product_name')">الاسم {!! getSortIcon($sortBy, $sortDir,$name='product_name') !!}</th>
                                        <th><span class=" badge  badge-warning mb-2">القسم</span></th>
                                        <th wire:click="setSortBy('price')">السعر {!! getSortIcon($sortBy, $sortDir,$name='price') !!}</th>
                                        <th>براند</th>
                                        <th width="200">الالوان</th>
                                        <th>المقاسات</th>
                                        <th>المسؤل</th>
                                        <th>الحاله</th>
                                        <th wire:click="setSortBy('created_at')">تاريخ الانشاء {!! getSortIcon($sortBy, $sortDir,$name='created_at') !!}</th>
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
                                                            wire:model.live="selected_ids"
                                                            value="{{ $product->id }}"
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
                                            <td>
                                                {{ $product->created_at->format('Y-m-d') }}
                                                <br>
                                                {{ $product->created_at->format('h:i') }}
                                                {{ $product->created_at->format('A') === 'AM' ? 'صباحا ' : 'مساء' }}
                                            </td>
                                            <td class="not-print">
                                                <a href="{{ route('products2.update', $product->id ) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-edit"></i></a>
                                                <a href="{{ route('products2.show', $product->id ) }}" class="btn btn-sm btn-warning">
                                                    <i class="fa fa-eye"></i></a>
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
</div>
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Checkbox select all toggle
    const selectAllCheckbox = document.getElementById('select-all');
    const individualCheckboxes = document.querySelectorAll('.selected_ids');

    selectAllCheckbox.addEventListener('change', function() {
        individualCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
});
</script>
@endpush
