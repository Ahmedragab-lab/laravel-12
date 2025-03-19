@extends('admin.layouts.master')
@section('css')

@endsection
@section('content')
{{-- <div>
    <h2>المنتجــــــــات</h2>
</div>
<ul class="breadcrumb mt-2">
    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
    <li class="breadcrumb-item">المنتجــــــــات</li>
</ul> --}}
@livewire('admin.products2')
@endsection
@push('js')

@endpush
{{--  --}}
