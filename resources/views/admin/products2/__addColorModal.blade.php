<div wire:ignore.self class="modal fade" id="addcolorModal" tabindex="-1" role="dialog" aria-labelledby="addcolorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addcolorModalLabel">لون جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>اسم اللون <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" wire:model.live="new_color_name">
                    @error('new_color_name')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="small-label">
                        تحديد اللون
                        <span class="text-danger">*</span>
                    </label>
                    <div class="d-flex align-items-center gap-2">
                        <input type="color" wire:model="new_color_code" style="width: 60px; height: 40px; padding: 0; border: none; cursor: pointer;" />

                        <input type="text" class="form-control" wire:model="color_code" placeholder="#FFFFFF" maxlength="7" />
                    </div>
                    @error('color_code')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-dismiss="modal">@lang('site.close')</button>
                <button type="button" class="btn btn-primary" wire:click="saveColor" data-dismiss="modal">@lang('site.save')</button>
                {{-- <button wire:loading.attr="disabled" type="submit" class="btn btn-success" wire:click="saveColor" data-dismiss="modal">
                    <span wire:loading.remove> @lang('site.save')</span>
                    <span wire:loading>Processing...</span>
                </button> --}}
            </div>
        </div>
    </div>
</div>
