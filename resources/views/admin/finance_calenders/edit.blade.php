@extends('admin.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            <p>A free and open source Bootstrap 4 admin template</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
    </div>
    <div class="row">
         <x-messages></x-messages>
        <div class="col-md-12">
            <div class="tile shadow">
                <form action="{{ route('finance_calender.update',$data['id']) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> كود السنة المالية</label>
                                <input type="text" name="FINANCE_YR" id="FINANCE_YR" class="form-control" value="{{old('FINANCE_YR',$data['FINANCE_YR'])  }}"
                                oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
                                @error('FINANCE_YR')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> وصف السنة المالية</label>
                                <input type="text" name="FINANCE_YR_DESC" id="FINANCE_YR_DESC" class="form-control" value="{{ old('FINANCE_YR_DESC',$data['FINANCE_YR_DESC']) }}" >
                                @error('FINANCE_YR_DESC')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> تاريخ بداية السنة المالية</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date',$data['start_date']) }}" >
                                @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> تاريخ نهاية السنة المالية</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date',$data['end_date']) }}" >
                                @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-sm btn-success" type="submit" name="submit">تحديث السنة </button>
                                <a href="{{ route('finance_calender.index') }}" class="btn btn-sm btn-danger">الغاء</a>
                            </div>
                         </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
