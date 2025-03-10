

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <form >
            @if($unit_id)
              <input type="hidden" wire:model="unit_id">
            @endif
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $name?'تعديل':'إضافة' }} {{ __('settings.unit') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="small-label" for="">{{ __('settings.Name') }}</label>
                            <input class="form-control" type="text" wire:model.live='name' placeholder="{{ __('settings.Name') }}">
                            {{ var_export($name) }}
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click='cancel()' class="btn btn-secondary" data-dismiss="modal">{{ __('settings.Close') }}</button>
                    {{-- <button type="submit" class="btn btn-primary" data-dismiss="modal">{{ __('settings.Save') }}</button> --}}
                    @if($unit_id)
                    <button  wire:click='update()' class="btn btn-primary" data-dismiss="modal">{{ __('settings.Update') }}</button>
                    @else
                    <button  wire:click='store()' class="btn btn-primary" data-dismiss="modal">{{ __('settings.Save') }}</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>



