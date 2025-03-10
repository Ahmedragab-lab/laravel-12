@extends('admin.layouts.master')
@push('css')
@endpush
@section('content')
    <div>
        <h2>الادوار</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">الادوار</li>
    </ul>
    <div>
        <div class="row">
            <x-messages></x-messages>
            <div class="col-md-12">
                <div class="tile shadow">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                                @lang('site.create')</a>
                        </div>
                    </div><!-- end of row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table datatable" id="users-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@lang('roles.name')</th>
                                            <th>@lang('roles.admins_count')</th>
                                            <th>@lang('site.created_at')</th>
                                            <th>@lang('site.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $info)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $info->name }}</td>
                                                <td>{{ $info->users_count }}</td>
                                                <td>{{ $info->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    @include('admin.roles.action')
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $data->links() }} --}}
                            </div><!-- end of table responsive -->
                        </div><!-- end of col -->
                    </div><!-- end of row -->
                </div><!-- end of tile -->
            </div><!-- end of col -->
        </div><!-- end of row -->
    </div>
@endsection
@push('js')
@endpush
