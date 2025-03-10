@extends('admin.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> الشفتات</h1>
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
                        <a href="{{ route('shiftes.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                            @lang('site.create')</a>
                    </div>
                </div><!-- end of row -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label> نوع الشفت </label>
                            <select name="type_search" id="type_search" class="form-control">
                                <option value="all"> بحث بالكل</option>
                                <option  value="1">صباحي</option>
                                <option  value="2">مسائي</option>
                             </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>     من عدد ساعات</label>
                            <input type="text" name="hour_from_range" id="hour_from_range" class="form-control" value="" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>     الي عدد ساعات</label>
                            <input type="text" name="hour_to_range" id="hour_to_range" class="form-control" value="" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" >
                        </div>
                    </div>
                </div><!-- end of row -->
                <div class="row">
                    <div class="col-md-12" id="ajax_responce_serachDiv">
                        @if ($data->count() > 0)
                            <div class="table-responsive">
                                <table class="table datatable" id="" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> نوع الشفت</th>
                                            <th> يبدأ من الساعة</th>
                                            <th> ينتهي الساعة</th>
                                            <th> عدد الساعات</th>
                                            <th> حالة التفعيل</th>
                                            <th> الاضافة بواسطة</th>
                                            <th> التحديث بواسطة</th>
                                            <th>@lang('site.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $info)
                                            <tr>
                                                <td> {{ $index + 1 }} </td>
                                                <td> {{ $info->type == 1 ? 'الصباحية' : 'الليلية' }} </td>
                                                <td>{{ formatTimeForDisplay($info->from_time) }}</td>
                                                <td>{{ formatTimeForDisplay($info->to_time) }}</td>
                                                <td> {{ $info->total_hour * 1 }} </td>
                                                <td class="badge badge-pill  {{ $info->active == 1 ? 'badge-primary' : 'badge-danger' }} text-center  mt-2"
                                                    style="color: #FFF;">
                                                    {{ $info->active == 1 ? 'مفعل' : 'معطل' }}
                                                </td>
                                                <td>
                                                    {{ $info->created_at->format('Y-m-d') }} <br>
                                                    {{ $info->created_at->format('h:i') }}
                                                    {{ $info->created_at->format('A') === 'AM' ? 'صباحا ' : 'مساء' }} <br>
                                                    {{ $info->added?->name }}
                                                </td>
                                                <td>
                                                    @if ($info->updated_by > 0)
                                                        {{ $info->updated_at?->format('Y-m-d') }} <br>
                                                        {{ $info->updated_at?->format('h:i') }}
                                                        {{ $info->updated_at?->format('A') === 'AM' ? 'صباحا ' : 'مساء' }}
                                                        <br>
                                                        {{ $info->updatedby?->name }}
                                                    @else
                                                        لايوجد
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('shiftes.edit',$info->id) }}"
                                                        class="btn btn-success btn-sm">تعديل
                                                        <i class="fa fa-info"></i></a>
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#delete{{ $info->id }}">حذف
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    @include('admin.shiftes.delete')
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <div class="col-md-12 text-center" id="ajax_pagination_in_search">
                                    {{ $data->links('pagination::bootstrap-5') }}
                                 </div>
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
<script>
    $(document).ready(function() {
        $(document).on('change', '#type_search', function(e) {
                ajax_search();
            });
            $(document).on('input', '#hour_from_range', function(e) {
                ajax_search();
            });

            $(document).on('input', '#hour_to_range', function(e) {
                ajax_search();
            });


            function ajax_search() {
                var type_search = $("#type_search").val();
                var hour_from_range = $("#hour_from_range").val();
                var hour_to_range = $("#hour_to_range").val();

                console.log(type_search);
                console.log(hour_from_range);
                console.log(hour_to_range);

                jQuery.ajax({
                    url: '{{ route('ShiftsTypes.ajax_search') }}',
                    type: 'post',
                    'dataType': 'html',
                    cache: false,
                    data: {
                        "_token": '{{ csrf_token() }}',
                        type_search: type_search,
                        hour_from_range: hour_from_range,
                        hour_to_range: hour_to_range
                    },
                    success: function(data) {
                        $("#ajax_responce_serachDiv").html(data);
                    },
                    error: function() {
                        alert("عفوا لقد حدث خطأ ");
                    }

                });

                $(document).on('click', '#ajax_pagination_in_search a', function(e) {
                    e.preventDefault();
                    var type_search = $("#type_search").val();
                    var hour_from_range = $("#hour_from_range").val();
                    var hour_to_range = $("#hour_to_range").val();
                    var linkurl = $(this).attr("href");
                    jQuery.ajax({
                        url: linkurl,
                        type: 'post',
                        'dataType': 'html',
                        cache: false,
                        data: {
                            "_token": '{{ csrf_token() }}',
                            type_search: type_search,
                            hour_from_range: hour_from_range,
                            hour_to_range: hour_to_range
                        },
                        success: function(data) {
                            $("#ajax_responce_serachDiv").html(data);
                        },
                        error: function() {
                            alert("عفوا لقد حدث خطأ ");
                        }

                    });

                });
            }
    });
</script>
@endpush
