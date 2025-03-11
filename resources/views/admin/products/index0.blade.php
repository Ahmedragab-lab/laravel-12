@extends('admin.layouts.master')
@section('css')

@endsection
@section('content')
<div>
    <h2>@lang('products.products')</h2>
</div>
<ul class="breadcrumb mt-2">
    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
    <li class="breadcrumb-item">@lang('products.products')</li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="tile shadow">
            <div class="row mb-2">
                <div class="col-md-12">
                    {{-- @if (auth()->product()->hasPermission('read_products')) --}}
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                    {{-- @endif --}}

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


            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table datatable" id="products-table" style="width: 100%;">
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
                                    <th>@lang('admins.image')</th>
                                    <th>@lang('products.name')</th>
                                    <th>@lang('products.email')</th>
                                    <th>@lang('products.phone')</th>
                                    <th>@lang('products.status')</th>
                                    <th>@lang('site.created_at')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>
                        </table>
                    </div><!-- end of table responsive -->
                </div><!-- end of col -->
            </div><!-- end of row --> --}}

            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-xl-2">
                                    <a href="ecommerce-add-new-products.html" class="btn btn-light mb-3 mb-lg-0"><i class="bx bxs-plus-square"></i>New Product</a>
                                </div>
                                <div class="col-lg-9 col-xl-10">
                                    <form class="float-lg-end">
                                        <div class="row row-cols-lg-auto g-2">
                                            <div class="col-12 d-flex flex-wrap justify-content-end align-items-center">
                                                <div class="position-relative mx-3">
                                                    <input type="text" class="form-control ps-5" placeholder="Search Product..." /> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                                                </div>
                                                <div class="btn-group mx-3" role="group" aria-label="Button group with nested dropdown">
                                                    <button type="button" class="btn btn-light">Sort By</button>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-light dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bx bx-chevron-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                            <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="btn-group mx-3" role="group" aria-label="Button group with nested dropdown">
                                                    <button type="button" class="btn btn-light">Collection Type</button>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-light dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bx bxs-category"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                            <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="btn-group mx-3" role="group">
                                                    <button type="button" class="btn btn-light">Price Range</button>
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-light dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bx bx-slider"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="btnGroupDrop1">
                                                            <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                            <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end of col -->
            </div><!-- end of row --> --}}


            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
                @foreach ($collection as $item)
                    @include('admin.components.product_single_body',[
                        'product' => $item
                    ])
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    <div aria-label="Page navigation example" class="navigation_body">
                        {{ $collection->links() }}
                    </div>
                </div>
            </div>

        </div><!-- end of tile -->
    </div><!-- end of col -->
</div><!-- end of row -->
@endsection
@push('js')

@endpush
{{--  --}}
