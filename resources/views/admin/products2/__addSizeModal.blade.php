<div wire:ignore.self class="modal fade" id="addsizeModal" tabindex="-1" role="dialog" aria-labelledby="addsizeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addsizeModalLabel">مقاس جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    <div class="form-group">
        <label>المقاس<span class="text-danger">*</span></label>
        <input type="text" class="form-control" wire:model.live="new_size_name">
        @error('new_size_name')<span class="text-danger">{{ $message }}</span>@enderror
    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-dismiss="modal">@lang('site.close')</button>
                <button type="button" class="btn btn-primary" wire:click="saveSize" data-dismiss="modal">@lang('site.save')</button>
            </div>
        </div>
    </div>
</div>
