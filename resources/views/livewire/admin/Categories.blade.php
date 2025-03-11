<div>
    <div>
        <h2>الأقسام</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">الأقسام</li>
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
                                    اسم القسم
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
                                   قسم جديد
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" id="data-table-search" class="form-control" autofocus
                                        placeholder="اسم القسم" wire:model.live='search'>
                                </div>
                            </div>
                        </div><!-- end of row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table datatable" id="categories-table" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>القسم</th>
                                                <th>عدد المنتجات</th>
                                                <th>{{ __('settings.created_at') }}</th>
                                                <th>@lang('site.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($categories as $index => $category)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->products_count }}</td>
                                                    <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-info" wire:click='edit({{ $category->id }})'>
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        
                                                        <x-delete-modal :item="$category" />
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan='5'>
                                                        <div class="alert alert-warning">
                                                            @lang('No results')
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{ $categories->links() }}
                                </div><!-- end of table responsive -->
                            </div><!-- end of col -->
                        </div><!-- end of row -->
                    </div><!-- end of tile -->
                </div><!-- end of col -->
            </div><!-- end of row -->
        </div>
    </div>
</div>
