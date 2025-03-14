
    <button type="button" class="btn btn-dark btn-sm delete mb-2" data-toggle="modal"
            data-target="#showbarcode{{ $product->id }}" title="@lang('products.barcode')">
        <i class="fa fa-vcard"></i>
    </button>
{{-- modal barcode --}}
    <div class="modal fade" id="showbarcode{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $product->name }}</h5>
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
{{-- end modal barcode --}}
{{-- @if (auth()->user()->hasPermission('update_users')) --}}
<a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm mb-2" title="@lang('site.edit')"><i class="fa fa-edit"></i> </a>
{{-- @endif --}}
<a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm mb-2" title="@lang('site.show')"><i class="fa fa-eye"></i> </a>
{{-- @if (auth()->user()->hasPermission('delete_users')) --}}
<button type="button" class="btn btn-danger btn-sm delete mb-2" data-toggle="modal" data-target="#delete{{ $product->id }}" title="@lang('site.delete')">
    <i class="fa fa-trash"></i>
</button>
{{-- @endif --}}
{{-- modal delete --}}
<div class="modal fade" id="delete{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">delete user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    are you sure to delete admin ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">نعم</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end modal delete --}}
{{-- modal bulk delete --}}
<div class="modal fade" id="bulkdelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">delete all user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('products.bulk_delete','ids') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    are you sure to delete user all ?
                </div>
                <input type="hidden" id="delete_all" name="delete_select_id" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Admin/site.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Admin/site.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--End modal bulk delete --}}
