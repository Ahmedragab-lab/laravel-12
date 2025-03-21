{{-- @if (auth()->user()->hasPermission('update_users')) --}}
<a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm" title="@lang('site.edit')"><i class="fa fa-edit"></i> </a>
{{-- @endif --}}
<a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info btn-sm" title="@lang('site.show')"><i class="fa fa-eye"></i> </a>
{{-- @if (auth()->user()->hasPermission('delete_users')) --}}
<button type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target="#delete{{ $product->id }}" title="@lang('site.delete')">
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
            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
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
                <h5 class="modal-title" id="exampleModalLabel">delete products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('products.bulk_delete','ids') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    are you sure to delete products all ?
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
