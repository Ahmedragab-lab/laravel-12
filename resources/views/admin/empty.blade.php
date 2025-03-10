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
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table datatable" id="users-table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- end of table responsive -->
                    </div><!-- end of col -->
                </div><!-- end of row -->
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="website_name"></label>
                            <input type="text" id="website_name" class="form-control" name="website_name" autocomplete="off">
                            @error('website_name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush


<div class="row">
    {{-- <x-messages></x-messages> --}}
    @include('admin.units.modal')
    <div class="col-md-12">
        <div class="tile shadow">
            <div class="row mb-2">
                <div class="col-md-12">
                    {{-- @if (auth()->user()->hasPermission('create_units')) --}}
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            {{ __('settings.Add_unit') }}
                            <i class="fa fa-plus"></i>
                        </button>

                </div>
            </div><!-- end of row -->
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {{ var_export($search) }}
                        <input type="text" id="data-table-search" class="form-control" autofocus placeholder="@lang('site.search')" wire:model.live='search'>
                    </div>
                </div>
            </div><!-- end of row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table datatable" id="users-table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('settings.Name') }}</th>
                                    <th>{{ __('settings.created_at') }}</th>
                                    {{-- @if (auth()->user()->hasPermission('update_units','delete_units'))
                                    @endif --}}
                                    <th>{{ __('settings.Control') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($units as $index => $unit)
                                    <tr>
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ $unit->name }}</td>
                                        <td>{{ $unit->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            {{-- @if (auth()->user()->hasPermission('update_units')) --}}
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal" wire:click="edit({{ $unit->id }})">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            {{-- @endif --}}
                                            {{-- @if (auth()->user()->hasPermission('delete_units')) --}}
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $unit->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            {{-- @endif --}}
                                            @include('admin.units.delete')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $units->links() }}
                    </div><!-- end of table responsive -->
                </div><!-- end of col -->
            </div><!-- end of row -->
        </div><!-- end of tile -->
    </div><!-- end of col -->
</div><!-- end of row -->
