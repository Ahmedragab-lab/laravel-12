@extends('admin.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> الفروع</h1>
            <p>A free and open source Bootstrap 4 admin template</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="{{ route('branches.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                            @lang('site.create')</a>
                    </div>
                </div><!-- end of row -->
                <div class="row">
                    <div class="col-md-12">
                        {{-- @if (@isset($data) and !@empty($data)) --}}
                        @if ($data->count()>0)
                            <div class="table-responsive">
                                <table class="table datatable" id="" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> كود الفرع</th>
                                            <th> الاسم</th>
                                            <th> العنوان</th>
                                            <th> الهاتف</th>
                                            <th> الايميل</th>
                                            <th> حالة التفعيل</th>
                                            <th> الاضافة بواسطة</th>
                                            <th> التحديث بواسطة</th>
                                            <th>@lang('site.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $info)
                                            <tr>
                                                <td> {{ $info->index + 1 }} </td>
                                                <td> {{ $info->id }} </td>
                                                <td> {{ $info->name }} </td>
                                                <td> {{ $info->address }} </td>
                                                <td> {{ $info->phones }} </td>
                                                <td> {{ $info->email }} </td>
                                                <td class="badge badge-pill  {{ $info->active == 1 ? 'badge-primary' : 'badge-danger' }} text-center  mt-2" style="color: #FFF;">
                                                    {{ $info->active == 1 ? 'مفعل' : 'معطل' }}
                                                </td>
                                                <td>{{ $info->added->name }} </td>
                                                <td>
                                                    @if ($info->updated_by > 0)
                                                        {{ $info->updatedby?->name }}
                                                    @else
                                                        لايوجد
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('branches.edit', $info->id) }}"
                                                        class="btn btn-success btn-sm">تعديل</a>
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#delete{{ $info->id }}">حذف
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    @include('admin.branches.delete')
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $data->links() }}
                            </div><!-- end of table responsive -->
                        @else
                            <p style="text-align: center; color:#fff; background-color: red;padding: 20px;"> عفوا لاتوجد
                                بيانات لعرضها</p>
                        @endif
                    </div><!-- end of col -->
                </div><!-- end of row -->
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
@endsection
@push('js')
@endpush
