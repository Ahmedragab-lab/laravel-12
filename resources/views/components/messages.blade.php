{{-- @if(session()->has('error'))
<div class="alert w-100 my-2 d-block px-2  alert-warning alert-dismissible ">
    <div class="d-flex align-items-center  gap-2    justify-content-between">
        <h6><i class="icon fas fa-exclamation-triangle"></i> {{ trans('admin.alert') }}!</h6>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
    {{ session('error') }}
</div>
@endif
@if(session()->has('success'))
<div class="alert w-50 my-2 d-block m-auto px-3 top-0 alert-success  alert-pop">
    <div class="d-flex align-items-center gap-2 justify-content-between">
        {{ session('success') }}
        <button type="button" class="close bg-transparent" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
</div>
@endif --}}
{{-- @if(count($errors->all()) > 0)
<div class="alert   my-2 d-block px-2  alert-warning alert-dismissible " role="alert">
    <div class="d-flex align-items-center  gap-2    justify-content-between">
        <h6><i class="icon fas fa-exclamation-triangle"></i> تحذير</h6>
        <ol>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ol>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
</div> --}}
@if(count($errors->all()) > 0)
<div class="alert" role="alert">
    <div class="alert alert-danger">
        <h6><i class="icon fa fa-exclamation-triangle"></i> تحذير</h6>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <ol>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ol>
    </div>
</div>
@endif
@if (session()->has('success'))
    <p class="alert alert-success" role="alert">{{ session('success') }}</p>
@endif
@if (session()->has('error'))
    <p class="alert alert-danger">{{ session('error') }}</p>
@endif
