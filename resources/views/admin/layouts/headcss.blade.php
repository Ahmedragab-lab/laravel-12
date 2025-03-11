<meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
<!-- Twitter meta-->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:site" content="@pratikborsadiya">
<meta property="twitter:creator" content="@pratikborsadiya">
<!-- Open Graph Meta-->
<meta property="og:type" content="website">
<meta property="og:site_name" content="Vali Admin">
<meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
<meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
<meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
<meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
<title>@yield('title')</title>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Main CSS-->
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/main-teal.css"> --}}
<!-- Font-icon css-->

@if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('admin/css/main-teal.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/font-awesome.min.css') }}">
    {{--google font--}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo:400,600&display=swap">
    <style>
        body {
            font-family: 'cairo', 'sans-serif';
        }

        .breadcrumb-item + .breadcrumb-item {
            padding-left: .5rem;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            padding-left: .5rem;
        }

        div.dataTables_wrapper div.dataTables_paginate ul.pagination {
            margin: 2px 2px;
        }
        .toggle-password{
            position: absolute;left: 25px;bottom: 10px;
        }
    </style>
@endif
@if (app()->getLocale() == 'en')
    <link rel="stylesheet" href="{{ asset('admin/css/main-blue.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/font-awesome.min.css') }}">
    <style>
        .toggle-password{
        position: absolute;right: 25px;bottom: 10px;
        }
    </style>
@endif
<link rel="stylesheet" href="{{ asset('admin/plugins/simplebar/css/simplebar.css')}}">
<link rel="stylesheet" href="{{ asset('admin/plugins/metismenu/css/metisMenu.min.css')}}">


<!-- Font-icon css-->
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

{{-- <link rel="stylesheet" href="{{ asset('admin/css/app-style.css')}}"> --}}
<link rel="stylesheet" href="{{ asset('admin/css/custom.css')}}">

{{--  --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
{{-- <script src="{{ asset('admin/js/jquery.min.js')}}"></script> --}}
<script src="{{ asset('admin') }}/js/jquery-3.3.1.min.js"></script>
<script>
    $.ajaxSetup({
        cache:false,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $( document ).ajaxSuccess((e,res)=>console.log((res.responseJSON && res.responseJSON) || res));
    $( document ).ajaxError(function( event, res ) {
        console.log(res.responseJSON.errors || res);
    });
    function toaster(icon, message){
        Toast.fire({
            icon: icon,
            title: message,
        })
    }
</script>



