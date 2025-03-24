<button type="button" class="btn btn-dark btn-sm " data-toggle="modal"
        data-target="#showbarcode{{ $product->id }}" title="@lang('products.barcode')">
    <i class="fa fa-vcard"></i>
</button>
<div class="modal fade" id="showbarcode{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 700px; text-align: center;">
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
