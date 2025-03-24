<div>
    <div>
        <h2>المنتجات</h2>
    </div>

    <!-- Breadcrumb -->
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">المنتجات</li>
    </ul>

    <!-- Messages -->
    <x-messages />

   <!-- Add Product Button -->
<a href="{{ route('products3.create') }}" class="btn btn-primary">
    اضف منتج جديد <i class="fa fa-plus"></i>
</a>


    <!-- Search -->
    <div class="form-group mb-4">
        <input type="text" class="form-control" placeholder="بحث..." wire:model="search">
    </div>

    <!-- Products Table -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>السعر</th>
                    <th>القسم</th>
                    <th>الماركة</th>
                    <th>مميز</th>
                    <th>متوفر</th>
                    <th>تخفيض</th>
                    <th>تاريخ الانشاء</th>
                    <th>اجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td>{{ $product->brand->name ?? '-' }}</td>
                        <td>{{ $product->is_featured ? 'نعم' : 'لا' }}</td>
                        <td>{{ $product->in_stock ? 'نعم' : 'لا' }}</td>
                        <td>{{ $product->on_sale ? 'نعم' : 'لا' }}</td>
                        <td>{{ $product->created_at->format('Y-m-d') }}</td>
                        <td>
                        <!-- Edit Product Button -->
                        <a href="{{ route('products3.edit', $product->id) }}" class="btn btn-info btn-sm">
                            تعديل
                        </a>
                            <button class="btn btn-danger btn-sm" wire:click="$set('productToDelete', {{ $product->id }})" data-toggle="modal" data-target="#deleteModal">حذف</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">لا يوجد منتجات</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
    @include('livewire.admin.products.delete-modal')

</div>
