<div>
    <div>
        <h2>الحيوانات</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">الحيوانات</li>
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
                                    اسم الحيوان
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="box-input">
                                    <input type="text" class="form-control" wire:model='name' id="" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="small-label" for="">
                                    العمر
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="box-input">
                                    <input type="number" class="form-control" wire:model='age' id="" />
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
                                   حيوان جديد
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-md-1">
                                <select class="form-control" wire:model.live='perPage'>
                                    <option value="">---</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" id="data-table-search" class="form-control" autofocus
                                        placeholder="اسم الحيوان" wire:model.live='search'>
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
                                                <th wire:click="setSortBy('name')">اسم الحيوان {!! getSortIcon($sortBy, $sortDir, $name='name') !!}</th>
                                                <th wire:click="setSortBy('age')">العمر {!! getSortIcon($sortBy, $sortDir, $name='age') !!}</th>
                                                <th wire:click="setSortBy('created_at')">تاريخ الانشاء {!! getSortIcon($sortBy, $sortDir, $name='created_at') !!}</th>
                                                <th>@lang('site.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($animals as $index => $animal)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $animal->name }}</td>
                                                    <td>{{ $animal->age }}</td>
                                                    <td>
                                                        {{ $animal->created_at->format('Y-m-d') }} <br>
                                                        {{ $animal->created_at->format('h:i') }}
                                                        {{ $animal->created_at->format('A') === 'AM' ? 'صباحا ' : 'مساء' }} <br>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-info" wire:click='edit({{ $animal->id }})'>
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <x-delete-modal :item="$animal" />
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
                                    {{ $animals->links() }}
                                </div><!-- end of table responsive -->
                            </div><!-- end of col -->
                        </div><!-- end of row -->
                    </div><!-- end of tile -->
                </div><!-- end of col -->
            </div><!-- end of row -->
        </div>
    </div>
</div>
