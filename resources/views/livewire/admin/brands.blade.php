<div>
    <div>
        <h2>البرندات</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">البرندات</li>
    </ul>
    <x-messages></x-messages>
    <div>
        <div>
            <div class="row">
                <div class="col-md-4">
                    <div class="tile shadow">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="small-label" for="">
                                    اسم البرند
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="box-input">
                                    <input type="text" class="form-control" wire:model='name' id="" />
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <button wire:click='submit' class="btn btn-primary">{{ __('settings.Save') }}</button>
                            </div>
                        </div><!-- end of row -->
                    </div><!-- end of tile -->
                </div><!-- end of col -->
                <div class="col-md-8">
                    <div class="tile shadow">
                        <div class="row">
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" wire:click='resetInputs'>
                                  اضف برند جديد
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {{-- {{ var_export($search) }} --}}
                                    <input type="text" id="data-table-search" class="form-control" autofocus
                                        placeholder="@lang('site.search')" wire:model.live='search'>
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
                                                <th>البرند</th>
                                                <th>{{ __('settings.created_at') }}</th>
                                                <th>@lang('site.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($brands as $index => $brand)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $brand->name }}</td>

                                                    <td>{{ $brand->created_at->format('Y-m-d') }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-info" wire:click='edit({{ $brand->id }})'>
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <x-delete-modal :item="$brand" />
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan='4'>
                                                        <div class="alert alert-warning">
                                                            @lang('No results')
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{ $brands->links() }}

                                </div><!-- end of table responsive -->
                            </div><!-- end of col -->
                        </div><!-- end of row -->
                    </div><!-- end of tile -->
                </div><!-- end of col -->
            </div><!-- end of row -->
        </div>
    </div>
</div>
