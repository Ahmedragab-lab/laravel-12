@extends('admin.layouts.master')
@push('css')
<style>
    a{
        text-decoration: none;
      }
      a:hover{
        text-decoration: none;
      }

</style>
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


    <div style="background-image: url({{ asset('admin/images/dashboard.jpg') }}); width: 100%; min-height: 800px; background-size: cover; ">
        <div class="row" style="padding: 20px;">
           <div class="col-md-6 col-lg-3">
               <div class="widget-small primary coloured-icon"><i class="icon fa fa-cogs fa-3x"></i>
                   <div class="info">
                    <a href="{{ route('company.settings') }}">
                        <h4>الظبط العام</h4>
                    </a>
                   </div>
               </div>
           </div>
           <div class="col-md-6 col-lg-3">
               <div class="widget-small info coloured-icon"><i class="icon fa fa-calendar fa-3x"></i>
                   <div class="info">
                        <a href="{{ route('finance_calender.index') }}">
                        <h4>السنوات الماليه</h4>
                        </a>
                   </div>
               </div>
           </div>
           <div class="col-md-6 col-lg-3">
               <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                   <div class="info">
                       <a href="{{ route('branches.index') }}">
                           <h4>الفروع</h4>

                           <p><b></b></p>
                       </a>
                   </div>
               </div>
           </div>
           <div class="col-md-6 col-lg-3">
               <div class="widget-small danger coloured-icon"><i class="icon fa fa-key fa-3x"></i>
                   <div class="info">
                    <a href="{{ route('shiftes.index') }}">
                        <h4>الشفتات</h4>
                    </a>
                       {{-- <p><b>500</b></p> --}}
                   </div>
               </div>
           </div>
        </div>
        {{-- <div class="row" style="padding: 20px;">
           <div class="col-md-6 col-lg-3">
               <div class="widget-small primary coloured-icon"><i class="icon fa fa-cogs fa-3x"></i>
                   <div class="info">
                    <a href="{{ route('company.settings') }}">
                        <h4>الظبط العام</h4>
                    </a>
                   </div>
               </div>
           </div>
           <div class="col-md-6 col-lg-3">
               <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
                   <div class="info">
                       <h4>Likes</h4>
                       <p><b>25</b></p>
                   </div>
               </div>
           </div>
           <div class="col-md-6 col-lg-3">
               <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                   <div class="info">
                       <h4>Uploades</h4>
                       <p><b>10</b></p>
                   </div>
               </div>
           </div>
           <div class="col-md-6 col-lg-3">
               <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
                   <div class="info">
                       <h4>Stars</h4>
                       <p><b>500</b></p>
                   </div>
               </div>
           </div>
        </div> --}}
    </div>

 @endsection
 @push('js')
 @endpush
{{--  --}}
