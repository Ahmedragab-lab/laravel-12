<div class="col-md-2 admin_product_individual_body">
    <div class="card position-relative">
        @if($product->thumb_image)
            <img src="{{display_file($product->thumb_image)}}"  class="card-img-top"
            alt="{{ $product->name }}" >
        @else
            <img src="{{ asset('no-image.jpg') }}"  alt="{{ $product->name }} " class="card-img-top">
        @endif
        <div class="">
            <div class="product-discount"><span class="">-{{ $product->discount }}%</span></div>
        </div>
        <div class="card-body">
            <h6 class="card-title ">{{ $product->name }}</h6>
            <div >{!! DNS1D::getBarcodeHTML($product->code . '', 'C128') !!}</div>


            {{-- {!! $qrCode !!} --}}

            <div class="clearfix d-flex justify-content-between">
                <p class="mb-0 "><strong>134</strong> Sales</p>
                <p class="mb-0  fw-bold">
                    <span class="me-2 text-decoration-line-through"><del>${{ $product->price }}</del></span>
                    <span class="text-white">${{ $product->discount_price }}</span>
                </p>
            </div>
            <div class="d-flex align-items-center mt-3 fs-6">
                <div class="cursor-pointer">
                    <i class="fa fa-star text-white"></i>
                    <i class="fa fa-star text-white"></i>
                    <i class="fa fa-star text-white"></i>
                    <i class="fa fa-star text-light-4"></i>
                    <i class="fa fa-star text-light-4"></i>
                </div>
                <p class="mb-0 ms-auto">4.2(182)</p>
            </div>
        </div>
        <div class="card-footer">
            <ul class="d-flex flex-wrap justify-content-end" style=" list-style: none;">
                <li><a href="{{ route('admin.products.edit',$product->id) }}" class="btn btn-sm btn-success ml-2">Edit</a></li>
                <li><a href="{{ route('admin.products.show',$product->id) }}" class="btn btn-sm btn-warning ml-2">View</a></li>
                <li><a href="{{ route('admin.products.destroy',$product->id) }}" data-parent=".admin_product_individual_body"
                    class="btn delete_btn btn-sm btn-danger ml-2">Delete</a></li>
            </ul>
        </div>
    </div>
</div>
