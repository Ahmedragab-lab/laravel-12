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
        {{-- <x-messages></x-messages> --}}
        <div class="col-md-12">
            <div class="tile shadow">
                <form action="{{ route('branches.update', $data->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> اسم الفرع</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $data['name']) }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> عنوان الفرع</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ old('address', $data['address']) }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> هاتف الفرع</label>
                                <input type="text" name="phones" id="phones" class="form-control"
                                    value="{{ old('phones', $data['phones']) }}">
                                @error('phones')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> ايميل الفرع</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email', $data['email']) }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> حالة التفعيل</label>
                                <select name="active" id="active" class="form-control">
                                    <option {{ old('active', $data['active']) == 1 ? 'selected' : '' }} value="1">مفعل
                                    </option>
                                    <option {{ old('active', $data['active']) == 0 ? 'selected' : '' }} value="0">معطل
                                    </option>
                                </select>
                                @error('active')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-sm btn-primary" type="submit" name="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i> تعديل فرع</button>
                                <a href="{{ route('branches.index') }}" class="btn btn-secondary btn-sm">
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
