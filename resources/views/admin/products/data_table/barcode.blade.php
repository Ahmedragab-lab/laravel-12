
    {{-- {!! DNS1D::getBarcodeHTML($product->code . '', 'C128') !!} --}}

    <button type="button" class="btn btn-dark btn-sm delete mb-2" data-toggle="modal" data-target="#showbarcode{{ $product->id }}" title="@lang('products.barcode')">
        <i class="fa fa-vcard"></i>
    </button>
{{-- modal delete --}}
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
                {!! DNS1D::getBarcodeHTML($product->code . '', 'C128') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                {{-- <button type="submit" class="btn btn-primary">نعم</button> --}}
            </div>
        </div>
    </div>
</div>
{{-- end modal delete --}}
