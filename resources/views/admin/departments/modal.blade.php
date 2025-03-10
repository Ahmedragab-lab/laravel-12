<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <form>
            @if ($department_id)
                <input type="hidden" wire:model="department_id">
            @endif
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $name ? 'تعديل' : 'إضافة' }} قســـــم
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="small-label" for="">{{ __('settings.Name') }}</label>
                            <input class="form-control" type="text" wire:model.live='name'
                                placeholder="{{ __('settings.Name') }}">
                            {{-- {{ var_export($name) }} --}}
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="small-label" for="">{{ __('admin.sub of') }}</p>
                            <select wire:model.live="parent"  class="form-control " >
                                <option value="">{{ __('admin.sub of') }}</option>
                                @foreach ($main as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            {{ var_export($parent) }}
                            @error('parent')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="alert alert-primary d-flex align-items-center" role="alert">
                            {{ __('In case the section is specific to the radiation or laboratory can be determined from here') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label ">{{ __('lab') }}</label>
                            <div class="form-check">
                                <label class="form-check-label ">
                                    <input class="form-check-input " type="radio" value="1"
                                        wire:model.live="is_lab">
                                    <span class="mr-4"> @lang('settings.on')</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" value="0"
                                        wire:model.live="is_lab">
                                    <span class="mr-4 "> @lang('settings.off')</span>
                                </label>
                            </div>
                            {{-- {{ var_export($is_lab) }} --}}
                            {{-- {{ $is_lab }} --}}
                        </div>
                        <div class="col-md-6">
                            <label class="control-label ">{{ __('scan') }}</label>
                            <div class="form-check">
                                <label class="form-check-label ">
                                    <input class="form-check-input " type="radio" value="1"
                                        wire:model.live="is_scan">
                                    <span class="mr-4"> @lang('settings.on')</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" value="0"
                                        wire:model.live="is_scan">
                                    <span class="mr-4 "> @lang('settings.off')</span>
                                </label>
                            </div>
                            {{-- {{ var_export($is_scan) }} --}}
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="alert alert-primary d-flex align-items-center" role="alert">
                            {{ __('You can activate the transfer service and appointments') }}
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <label class="control-label ">{{ __('admin.Transferable patients') }}</label>
                            <div class="form-check">
                                <label class="form-check-label ">
                                    <input class="form-check-input " type="radio" value="1"
                                        wire:model.live="transferstatus">
                                    <span class="mr-4"> @lang('settings.on')</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" value="0"
                                        wire:model.live="transferstatus">
                                    <span class="mr-4 "> @lang('settings.off')</span>
                                </label>
                            </div>
                            {{-- {{ var_export($transferstatus) }} --}}
                        </div>
                        <div class="col-md-6">
                            <label class="control-label ">{{ __('Appointment Status') }}</label>
                            <div class="form-check">
                                <label class="form-check-label ">
                                    <input class="form-check-input " type="radio" value="1"
                                        wire:model.live="appointmentstatus">
                                    <span class="mr-4"> @lang('settings.on')</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" value="0"
                                        wire:model.live="appointmentstatus">
                                    <span class="mr-4 "> @lang('settings.off')</span>
                                </label>
                            </div>
                            {{-- {{ var_export($appointmentstatus) }} --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click='cancel()' class="btn btn-secondary"
                        data-dismiss="modal">{{ __('admin.back') }}</button>
                    {{-- <button type="submit" class="btn btn-primary" data-dismiss="modal">{{ __('settings.Save') }}</button> --}}
                    @if ($department_id)
                        <button wire:click='update()' class="btn btn-primary"
                            data-dismiss="modal">{{ __('settings.Save') }}</button>
                    @else
                        <button wire:click='store()' class="btn btn-primary"
                            data-dismiss="modal">{{ __('settings.Save') }}</button>
                    @endif
                    {{-- <button  wire:click='save()' class="btn btn-primary" data-dismiss="modal">{{ __('admin.Save') }}</button> --}}
                </div>
            </div>
        </form>
    </div>
</div>
