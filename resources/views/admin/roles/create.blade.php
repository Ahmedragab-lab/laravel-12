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
    <div class="row">
        <x-messages></x-messages>
        <div class="col-md-12">
            <div class="tile shadow">
                <form action="{{ route('roles.store') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> اسم الدور</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="projectinput1">@lang('admins.permissions')</label>
                                <div class="inp-holder mb-2 ">
                                    <label for="name">{{ __('admins.selectall') }}</label>
                                    <input type="checkbox"  id="selectall" >
                                </div>
                                <div class="table-holder">
                                    <div class="table-responsive">
                                        <table class="table main-table">
                                            <thead>
                                                <tr>
                                                    <th>@lang('roles.model')</th>
                                                    <th>{{ __('admins.selectall') }}</th>
                                                    @foreach($permissionMaps as $key => $value)
                                                        <th>@lang('site.' . $value)
                                                        <div  style="display:inline-block;" >
                                                            <label class="m-0">
                                                                <input type="checkbox" value=""  onclick="SelectAll(this)"  class="side-roles" id="side-roles">
                                                            </label>
                                                        </div>
                                                        </th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($models as $index=>$model)
                                                    <tr>
                                                        <td>@lang($model . '.' . $model)</td>
                                                        <td>
                                                            <div class="animated-checkbox mx-2" style="display:inline-block;">
                                                                <label class="m-0">
                                                                    <input type="checkbox" value=""  class="all-roles" id="all-roles">
                                                                    <span class="label-text">{{ __('admins.all') }}</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        @foreach ($permissionMaps as $key=>$permissionMap )
                                                            <td>
                                                                <div class="animated-checkbox mx-2" style="display:inline-block;">
                                                                    <label class="m-0">
                                                                        <input type="checkbox" value="{{ $permissionMap . '_' . $model }}"
                                                                        name="permissions[]" class="role" id='role_{{ $key }}'>
                                                                        <span class="label-text">
                                                                            @lang('site.' . $permissionMap) @lang($model . '.' . $model)
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @error('permissions')<p class="text-danger" style="font-size: 12px">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="submit" name="submit">
                                <i class="fa fa-fw fa-lg fa-check-circle"></i> اضف دور</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fa fa-fw fa-lg fa-times-circle"></i> الغاء</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('#selectall').click(function(event) {  //on click
            // console.log('hello');
            if(this.checked) { // check select status
                $('.role').each(function() { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "role"
                });
            }else{
                $('.role').each(function() { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "role"
                });
            }
            var chkArray = [];
            $("input[name='check[]']:checked").map(function() {
                chkArray.push(this.value);
            }).get();
            var selected;
            selected = chkArray.join(',') + ",";
            // if(selected.length > 1){
            //     alert('هل تريد تحديد الكل?');
            // } else { alert(' تحديد الكل'); }
        });
    });
</script>
<script>
        $(function () {
        $(document).on('change', '.all-roles', function () {
            $(this).parents('tr').find('input[type="checkbox"]').prop('checked', this.checked);
        });
        $(document).on('change', '.role', function () {
            if (!this.checked) {
                $(this).parents('tr').find('.all-roles').prop('checked', this.checked);
            }
            // else{
            //     $(this).parents('tr').find('.all-roles').prop('checked', this.checked);
            // }
        });

    });//end of document ready

</script>
<script>
   function SelectAll(obj) {
       var table = $(obj).closest('table');
       var th_s = table.find('th');
       var current_th = $(obj).closest('th');
       var columnIndex = th_s.index(current_th) + 1;
       table.find('td:nth-child(' + (columnIndex) + ') input').prop("checked", obj.checked);
   }
</script>

@endpush
