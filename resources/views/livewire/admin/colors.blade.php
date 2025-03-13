<div>
    <!-- Breadcrumbs and Messages -->
    <div>
        <h2>الالوان</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">الالوان</li>
    </ul>
    <x-messages></x-messages>
    
    <!-- Main Content Wrapper -->
    <div class="row">
        <!-- Form Section -->
        <div class="col-md-4">
            <div class="tile shadow">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="small-label">
                            اسم اللون
                            <span class="text-danger">*</span>
                        </label>
                        <div class="box-input">
                            <input type="text" class="form-control" wire:model='name' placeholder="أدخل اسم اللون" />
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="small-label">
                            تحديد اللون
                            <span class="text-danger">*</span>
                        </label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="color" class="form-control" wire:model='color_code' style="width: 60px; height: 40px; padding: 0; border: none; cursor: pointer;" />
                            <input type="text" class="form-control" wire:model='color_code' placeholder="#FFFFFF" maxlength="7" />
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <button wire:click='submit' class="btn btn-primary">{{ __('settings.Save') }}</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colors Table Section -->
        <div class="col-md-8">
            <div class="tile shadow">
                <div class="row mb-2">
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" wire:click='resetInputs'>
                            لون جديد <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus placeholder="اسم اللون" wire:model.live='search'>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table datatable" id="colors-table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اللون</th>
                                        <th>  </th>
                                        <th>عدد المنتجات</th>
                                        <th>{{ __('settings.created_at') }}</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($colors as $index => $color)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <span style="display: inline-block; width: 20px; height: 20px; background-color: {{ $color->color_code }}; border-radius: 50%;"></span>
                                        </td>
                                        <td>{{ $color->name . '.' }}</td>
                                        <td class="btn btn-success btn-sm">{{ $color->related_products_count }}</td>
                                        <td>{{ $color->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info" wire:click='edit({{ $color->id }})'>
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <x-delete-modal :item="$color" />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="alert alert-warning">
                                            لا يوجد بيانات
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div><!-- end of table responsive -->
                    </div><!-- end of col -->
                </div><!-- end of row -->
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
</div>
