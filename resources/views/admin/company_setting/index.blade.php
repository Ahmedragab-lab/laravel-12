@extends('admin.layouts.master')
@push('css')
<style>
    .width30{
        width: 30%;
    }
</style>
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> الظبط العام</h1>
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
                        @if(!@isset($data))
                            <a href="{{ route('company.settings.edit') }}" class="btn btn-primary" >
                                <i class="fa fa-plus"></i> اضف اعدادات الشركه
                            </a>
                        @endif
                    </div>
                </div><!-- end of row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            @if(@isset($data) and !@empty($data))
                                <table class="table datatable" id="users-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="width30">#</th>
                                            <th>بيانات الشركه</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="width30">اسم الشركة</td>
                                            <td> {{ $data['company_name'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30"> حالة التفعيل</td>
                                            <td>{{ $data->system_status? 'مفعل' : 'معطل' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">هاتف الشركة</td>
                                            <td> {{ $data['phones'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">عنوان الشركة</td>
                                            <td> {{ $data['address'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">بريد الشركة</td>
                                            <td> {{ $data['email'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30"> بعد كم دقيقة نحسب تاخير حضور	</td>
                                            <td> {{ $data['after_miniute_calculate_delay'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30"> بعد كم دقيقة نحسب انصراف مبكر	</td>
                                            <td> {{ $data['after_miniute_calculate_delay'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30"> بعد كم دقيقه مجموع الانصراف المبكر او الحضور المتأخر نحصم ربع يوم	</td>
                                            <td> {{ $data['after_miniute_quarterday'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30"> بعد كم مرة تأخير او انصارف مبكر نخصم نص يوم	</td>
                                            <td> {{ $data['after_time_half_daycut'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">نخصم بعد كم مره تاخير او انصارف مبكر يوم كامل	</td>
                                            <td> {{ $data['after_time_allday_daycut'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">رصيد اجازات الموظف الشهري	</td>
                                            <td> {{ $data['monthly_vacation_balance'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">بعد كم يوم ينزل للموظف رصيد اجازات	</td>
                                            <td> {{ $data['after_days_begin_vacation'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">الرصيد الاول المرحل عند تفعيل الاجازات للموظف مثل نزول عشرة ايام ونص بعد سته شهور للموظف	</td>
                                            <td> {{ $data['first_balance_begin_vacation'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">قيمة خصم الايام بعد اول مرة غياب بدون اذن	</td>
                                            <td> {{ $data['sanctions_value_first_abcence'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">قيمة خصم الايام بعد ثاني مرة غياب بدون اذن	  	</td>
                                            <td> {{ $data['sanctions_value_second_abcence'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">قيمة خصم الايام بعد ثالث مرة غياب بدون اذن	 	</td>
                                            <td> {{ $data['sanctions_value_third_abcence'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">قيمة خصم الايام بعد رابع مرة غياب بدون اذن	 	</td>
                                            <td> {{ $data['sanctions_value_forth_abcence'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30"></td>
                                            <td >
                                                <a href="{{ route('company.settings.edit') }}" class="btn btn-info">
                                                    <i class="fa fa-edit"></i> تعديل
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <p style="text-align: center; color:#fff; background-color: red;padding: 20px;"> عفوا لاتوجد بيانات لعرضها</p>
                            @endif
                        </div><!-- end of table responsive -->
                    </div><!-- end of col -->
                </div><!-- end of row -->
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
@endsection
@push('js')
@endpush
