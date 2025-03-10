@extends('admin.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> تعديل الظبط العام</h1>
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
                <form action="{{ route('company.settings.update') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>اسم الشركة</label>
                                <input type="text" id="company_name" class="form-control" name="company_name" value="{{ old('company_name',$data?->company_name) }}" autocomplete="off">
                                @error('company_name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>هاتف الشركة</label>
                                <input type="text" id="phones" class="form-control" name="phones" value="{{ old('phones',$data?->phones) }}" oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
                                @error('phones')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>بريد الشركة	</label>
                                <input type="email" id="email" class="form-control" name="email" value="{{ old('email',$data?->email) }}" autocomplete="off">
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>عنوان الشركه</label>
                                <input type="text" id="address" class="form-control" name="address" value="{{ old('address',$data?->address) }}" autocomplete="off">
                                @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>بعد كم دقيقة نحسب تاخير حضور	</label>
                                <input type="text" id="after_miniute_calculate_delay" class="form-control" name="after_miniute_calculate_delay"
                                       value="{{ old('after_miniute_calculate_delay',$data?->after_miniute_calculate_delay) }}"
                                       oninput="this.value=this.value.replace(/[^0-9.]/g,'');" autocomplete="off">
                                @error('after_miniute_calculate_delay')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>بعد كم دقيقة نحسب انصراف مبكر</label>
                                <input type="text" id="after_miniute_calculate_early_departure" class="form-control" name="after_miniute_calculate_early_departure"
                                       value="{{ old('after_miniute_calculate_early_departure',$data?->after_miniute_calculate_early_departure) }}"
                                       oninput="this.value=this.value.replace(/[^0-9.]/g,'');" autocomplete="off">
                                @error('after_miniute_calculate_early_departure')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <small>بعد كم دقيقه مجموع الانصراف المبكر او الحضور المتأخر نحصم ربع يوم</small>
                                <input type="text" id="after_miniute_quarterday" class="form-control" name="after_miniute_quarterday"
                                       value="{{ old('after_miniute_quarterday',$data?->after_miniute_quarterday) }}"
                                       oninput="this.value=this.value.replace(/[^0-9.]/g,'');" autocomplete="off">
                                @error('after_miniute_quarterday')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> بعد كم مرة تأخير او انصارف مبكر نخصم نص يوم</label>
                                <input type="text" id="after_time_half_daycut" class="form-control" name="after_time_half_daycut"
                                       value="{{ old('after_time_half_daycut',$data?->after_time_half_daycut) }}"
                                       oninput="this.value=this.value.replace(/[^0-9.]/g,'');" autocomplete="off">
                                @error('after_time_half_daycut')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> نخصم بعد كم مره تاخير او انصارف مبكر يوم كامل</label>
                                <input type="text" id="after_time_allday_daycut" class="form-control" name="after_time_allday_daycut"
                                       value="{{ old('after_time_allday_daycut',$data?->after_time_allday_daycut) }}"
                                       oninput="this.value=this.value.replace(/[^0-9.]/g,'');" autocomplete="off">
                                @error('after_time_allday_daycut')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> رصيد اجازات الموظف الشهري</label>
                                <input type="text" id="monthly_vacation_balance" class="form-control" name="monthly_vacation_balance"
                                       value="{{ old('monthly_vacation_balance',$data?->monthly_vacation_balance) }}"
                                       oninput="this.value=this.value.replace(/[^0-9.]/g,'');" autocomplete="off">
                                @error('monthly_vacation_balance')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> بعد كم يوم ينزل للموظف رصيد اجازات</label>
                                <input type="text" id="after_days_begin_vacation" class="form-control" name="after_days_begin_vacation"
                                       value="{{ old('after_days_begin_vacation',$data?->after_days_begin_vacation) }}"
                                       oninput="this.value=this.value.replace(/[^0-9.]/g,'');" autocomplete="off">
                                @error('after_days_begin_vacation')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <small> الرصيد الاول المرحل عند تفعيل الاجازات للموظف مثل نزول عشرة ايام ونص بعد سته شهور للموظف</small>
                                <input type="text" id="first_balance_begin_vacation" class="form-control" name="first_balance_begin_vacation"
                                       value="{{ old('first_balance_begin_vacation',$data?->first_balance_begin_vacation) }}"
                                       oninput="this.value=this.value.replace(/[^0-9.]/g,'');" autocomplete="off">
                                @error('first_balance_begin_vacation')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> قيمة خصم الايام بعد اول مرة غياب بدون اذن	</label>
                                <input type="text" id="sanctions_value_first_abcence" class="form-control" name="sanctions_value_first_abcence"
                                       value="{{ old('sanctions_value_first_abcence',$data?->sanctions_value_first_abcence) }}"
                                       oninput="this.value=this.value.replace(/[^0-9.]/g,'');" autocomplete="off">
                                @error('sanctions_value_first_abcence')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> قيمة خصم الايام بعد ثاني مرة غياب بدون اذن</label>
                                <input type="text" id="sanctions_value_second_abcence" class="form-control" name="sanctions_value_second_abcence"
                                       value="{{ old('sanctions_value_second_abcence',$data?->sanctions_value_second_abcence) }}"
                                       oninput="this.value=this.value.replace(/[^0-9.]/g,'');" autocomplete="off">
                                @error('sanctions_value_second_abcence')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> قيمة خصم الايام بعد ثالث مرة غياب بدون اذن</label>
                                <input type="text" id="sanctions_value_third_abcence" class="form-control" name="sanctions_value_third_abcence"
                                       value="{{ old('sanctions_value_third_abcence',$data?->sanctions_value_third_abcence) }}"
                                       oninput="this.value=this.value.replace(/[^0-9.]/g,'');" autocomplete="off">
                                @error('sanctions_value_third_abcence')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> قيمة خصم الايام بعد رابع مرة غياب بدون اذن</label>
                                <input type="text" id="sanctions_value_forth_abcence" class="form-control" name="sanctions_value_forth_abcence"
                                       value="{{ old('sanctions_value_forth_abcence',$data?->sanctions_value_forth_abcence) }}"
                                       oninput="this.value=this.value.replace(/[^0-9.]/g,'');" autocomplete="off">
                                @error('sanctions_value_forth_abcence')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
