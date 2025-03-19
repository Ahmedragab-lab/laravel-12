<div>
    <div>
        <h2>المستخدمين</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">المستخدمين</li>
    </ul>
    <x-messages></x-messages>
    <div>
        <div>
            <div class="row">
                <div class="col-md-4">
                    <div class="tile shadow">
                        <div class="row">
                            <div class="col-md-12">
                                <label>الاسم</label>
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
                                <label>النوع</label>
                                <select class="form-control" wire:model='type'>
                                    <option value="">اختر النوع</option>
                                    <option value="user">مستخدم</option>
                                    <option value="admin">مشرف</option>
                                </select>
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
                                    <th>الاسم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>النوع</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->type }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" wire:click='edit({{ $user->id }})'>تعديل</button>
                                            <button class="btn btn-danger btn-sm" wire:click='delete({{ $user->id }})'>حذف</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
