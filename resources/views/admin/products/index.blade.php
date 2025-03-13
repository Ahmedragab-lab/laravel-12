@extends('admin.layouts.master')
@section('css')

@endsection
@section('content')
<div>
    <h2>المنتجــــــــات</h2>
</div>
<ul class="breadcrumb mt-2">
    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
    <li class="breadcrumb-item">المنتجــــــــات</li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="tile shadow">
            <div class="row mb-2">
                <div class="col-md-12">
                    {{-- @if (auth()->product()->hasPermission('read_products')) --}}
                        <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                    {{-- @endif --}}
                    @if($brand)
                        <div class="alert alert-info">
                            Showing products for brand: {{ $brand->name }}
                            <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary ml-2">
                                <i class="fas fa-times"></i> Clear filter
                            </a>
                        </div>
                    @endif
                    {{-- @if (auth()->product()->hasPermission('delete_products')) --}}
                        <button type="button" class="btn btn-danger" id="btn_delete_all" data-toggle="modal"
                                data-target="#bulkdelete" ><i class="fa fa-trash"></i>
                                @lang('site.bulk_delete')
                        </button>
                    {{-- @endif --}}
                </div>
            </div><!-- end of row -->
            <div class="row">
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
                                    <th>تاريخ انشاء</th>
                                    {{-- <th>@lang('site.action')</th> --}}
                                </tr>
                            </thead>
                        </table>
                    </div><!-- end of table responsive -->
                </div><!-- end of col -->
            </div><!-- end of row -->
        </div><!-- end of tile -->
    </div><!-- end of col -->
</div><!-- end of row -->
@endsection
@push('js')
<script>
    let productsTable = $('#products-table').DataTable({
    // dom: 'lBrtip',
    dom: 'Bprltip',
    buttons: ['excel','pdf',
        {
            extend: 'print',
            text: 'Print selected',
            exportOptions: {
                columns: ':visible'
            }
        },
        'colvis'
    ],
        autoWidth: true,
        responsive: true,
        serverSide: true,
        processing: true,
        Savestate :true,
        select: true,
        scrollX: true,
        scrollY: '70vh',
        scrollCollapse: true,
        pagingType: "full_numbers",
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "language": {
            "url": "{{ asset('admin/datatable-lang/' . app()->getLocale() . '.json') }}"
        },
        ajax: {
            url: '{{ route('products.index') }}',
            data: function(d) {
                d.brand_id = "{{ request('brand_id') }}";
            }
        },
        columns: [
            {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
            {data: 'DT_RowIndex', name: '', orderable: false, searchable: false},
            {data: 'image', name: 'image',orderable: false,width: '10%'},
            {data: 'product_name', name: 'product_name',width: '10%'},
            {data: 'category', name: 'category', orderable: false,width: '20%'},
            {data: 'price', name: 'price'},
            {data: 'brand', name: 'brand',orderable: false,width: '10%'},
            {data: 'colors', name: 'colors', orderable: false,width: '10%'},
            {data: 'sizes', name: 'sizes', orderable: false,width: '10%'},
            {data: 'creator', name: 'creator', orderable: true,searchable: false, width: '5%'},
            {data: 'created_at', name: 'created_at', orderable: true,searchable: false, width: '10%'},
            // {data: 'actions', name: 'actions', searchable: false, sortable: false, orderable: false, width: '10%'},
        ],
        order: [[10, 'desc']],
    });

    $('#data-table-search').keyup(function () {
        productsTable.search(this.value).draw();
    })

</script>
@endpush
{{--  --}}
