@extends('admin.layouts.master')
@section('content')
    <div>
        <h2>@lang('units.units')</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('units.units')</li>
    </ul>
    <livewire:units />
@endsection
