<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <form>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $name ? 'تعديل' : 'إضافة' }} منتـــج
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="small-label" for="">{{ __('settings.Name') }}</label>
                            <input class="form-control" type="text" wire:model='name'
                                placeholder="{{ __('settings.Name') }}">
                            {{-- {{ var_export($name) }} --}}
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="small-label" for="">{{ __('admin.department') }}</p>
                            <select wire:model.live="department_id"  class="form-control " >
                                <option value="">{{ __('admin.Choose the department') }}</option>
                                @foreach ($departments as $department)
                                  <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            {{-- {{ var_export($department_id) }} --}}
                            @error('department_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="small-label" for="">{{ __('admin.price') }}</label>
                            <input class="form-control" type="text" wire:model.live='price'
                                placeholder="{{ __('admin.price') }}"  oninput="this.value=this.value.replace(/[^0-9.]/g,'');" >
                            {{-- {{ var_export($price) }} --}}
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click='cancel()' class="btn btn-secondary"
                        data-dismiss="modal">{{ __('admin.back') }}</button>
                    <button  wire:click='save()' class="btn btn-primary" data-dismiss="modal">{{ __('admin.Save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
