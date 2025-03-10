
@if (@isset($data) and !@empty($data) and count($data) > 0)
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
                            <a href="{{ route('shiftes.edit', $info->id) }}" class="btn btn-success btn-sm">تعديل
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
