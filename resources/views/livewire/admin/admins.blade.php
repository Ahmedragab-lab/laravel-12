<div>
    <div>
        <h2>المشرفين</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">المشرفين</li>
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
                                    صورة المشرف
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="box-input">
                                    <input type="file" class="form-control" wire:model='image' id="" />
                                </div>
                                <div class="box-input">
                                    <div class="col-md-3">
                                        @if ($image instanceof \Illuminate\Http\UploadedFile)
                                            <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" width="100" />
                                        @elseif (is_string($image) && !empty($image))
                                            <img src="{{ display_file($image) }}" class="img-thumbnail" width="100" />
                                        @else
                                            <img src="{{ asset('no-image.jpg') }}" class="img-thumbnail" width="100" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>اسم المشرف</label>
                                <input type="text" class="form-control" wire:model='name' />
                            </div>
                            <div class="col-md-12">
                                <label>البريد الإلكتروني</label>
                                <input type="email" class="form-control" wire:model='email' />
                            </div>
                            <div class="col-md-12">
                                <label>كلمة المرور</label>
                                <input type="password" class="form-control" wire:model='password' />
                            </div>
                            <div class="col-md-12">
                                <label>الهاتف</label>
                                <input type="text" class="form-control" wire:model='phone' />
                            </div>
                            <div class="col-md-12 mt-3"> 
                                <button wire:click='submit' class="btn btn-primary">@lang('settings.Save')</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tile shadow">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="بحث..." wire:model='search' />
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" wire:model='perPage'>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الصورة</th>
                                    <th>اسم المشرف</th>
                                    <th>عدد تسجيلات الدخول</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>الهاتف</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $index => $admin)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if ($admin->image)
                                                <img src="{{ display_file($admin->image) }}" class="img-thumbnail" width="50" />
                                            @else
                                                <img src="{{ asset('no-image.jpg') }}" class="img-thumbnail" width="50" />
                                            @endif
                                        </td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->visit_count }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->phone }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" wire:click='edit({{ $admin->id }})'>تعديل</button>
                                            @if ($admin->id != auth()->id())
                                            <button class="btn btn-danger btn-sm" wire:click='delete({{ $admin->id }})'>حذف</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $admins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
