@extends('admin.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> السنوات الماليه</h1>
            <p>A free and open source Bootstrap 4 admin template</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
    </div>
    <div class="row">
        {{-- <x-messages></x-messages> --}}
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-12">
                            <a href="{{ route('finance_calender.create') }}" class="btn btn-primary" >
                                {{ __('settings.Add_unit') }}
                                <i class="fa fa-plus"></i>
                            </a>
                    </div>
                </div><!-- end of row -->
                <div class="row">
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            {{ var_export($search) }}
                            <input type="text" id="data-table-search" class="form-control" autofocus placeholder="@lang('site.search')" wire:model.live='search'>
                        </div>
                    </div> --}}
                </div><!-- end of row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            {{-- @if (@isset($data) and !@empty($data)) --}}
                            @if ($data->count()>0)
                                <table class="table datatable" id="" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> كود السنة</th>
                                            <th> وصف السنة</th>
                                            <th> تاريخ البداية</th>
                                            <th> تاريخ النهاية</th>
                                            <th> الاضافة بواسطة</th>
                                            <th> التحديث بواسطة</th>
                                            <th> تاريخ</th>
                                            <th> العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $index => $info)
                                            <tr>
                                                <td>{{ $index +1 }}</td>
                                                <td>{{ $info->FINANCE_YR }} </td>
                                                <td>{{ $info->FINANCE_YR_DESC }} </td>
                                                <td>{{ $info->start_date }} </td>
                                                <td>{{ $info->end_date }} </td>
                                                <td>{{ $info->added?->name }} </td>
                                                <td>{{ $info->updatedby->name ?? 'لا يوجد' }}</td>
                                                <td>{{ $info->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    @if ($info->is_open == 0)
                                                        @if ($CheckDataOpenCounter == 0)
                                                            <a href="{{ route('finance_calender.do_open', $info->id) }}"
                                                                class="btn btn-primary btn-sm">فتح
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('finance_calender.edit', $info->id) }}" class="btn btn-success btn-sm">تعديل
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $info->id }}">حذف
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        @include('admin.finance_calenders.delete')
                                                        <button class="btn btn-sm btn-info show_year_monthes"  data-id="{{ $info->id }}">عرض الشهور
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    @else
                                                        سنة مالية مفتوحه
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $data->links() }}
                            @else
                              <p style="text-align: center; color:#fff; background-color: red;padding: 20px;"> عفوا لاتوجد بيانات لعرضها</p>
                            @endif
                        </div><!-- end of table responsive -->
                    </div><!-- end of col -->
                </div><!-- end of row -->
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->

    <div class="modal fade " id="show_year_monthesModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">عرض الشهور للسنة المالية</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="show_year_monthesModalBody">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-outline-light">Save changes</button> --}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $(document).on('click', '.show_year_monthes', function() {
            var id = $(this).data('id');
            console.log(id);
            jQuery.ajax({
                url: '{{ route('finance_calender.show_year_monthes') }}',
                type: 'post',
                'dataType': 'html',
                cache: false,
                data: {
                    "_token": '{{ csrf_token() }}',
                    'id': id
                },
                success: function(data) {
                    $("#show_year_monthesModalBody").html(data);
                    $("#show_year_monthesModal").modal("show");
                },
                error: function() {
                    alert('error');
                }
            });
        });
    });
</script>
@endpush
