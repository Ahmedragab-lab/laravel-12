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
        <x-messages></x-messages>
        <div class="col-md-12">
            <div class="tile shadow">
                <form action="{{ route('shiftes.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> نوع الشفت </label>
                                <select name="type" id="type" class="form-control">
                                   <option value="">اختر النوع</option>
                                   <option @if(old('type')==1) selected @endif value="1">صباحي</option>
                                   <option @if(old('type')==2) selected @endif value="2">مسائي</option>
                                </select>
                                @error('type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>   يبدأ من الساعة </label>
                                <input type="time" name="from_time" id="from_time" class="form-control" value="{{ old('from_time') }}" >
                                @error('from_time')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>   ينتهي  الساعة </label>
                                <input type="time" name="to_time" id="to_time" class="form-control" value="{{ old('to_time') }}" >
                                @error('to_time')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>    عدد الساعات</label>
                                    <input type="text" name="total_hour" id="total_hour" class="form-control" value="{{ old('total_hour') }}" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" >
                                    @error('total_hour')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                 </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> حالة التفعيل</label>
                                <select  name="active" id="active" class="form-control">
                                <option   @if(old('active')==1) selected @endif  value="1">مفعل</option>
                                <option @if(old('active')==0 and old('active')!='') selected @endif value="0">معطل</option>
                                </select>
                                @error('active')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-sm btn-primary" type="submit" name="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i> اضف الشفت</button>
                                <a href="{{ route('shiftes.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-fw fa-lg fa-times-circle"></i> الغاء</a>
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
