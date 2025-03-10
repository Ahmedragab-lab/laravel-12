@extends('admin.layouts.master')
@push('css')

@endpush
@section('content')
    <div>
        <h2>الاقســـــــــــــــــــام</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">الاقسام</li>
    </ul>
    <livewire:departments />
@endsection
@push('js')

@endpush

