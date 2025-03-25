<div class="modal fade" id="bulkdelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف المنتجات المختاره</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    هل متاكد من الحذف ؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('close') }}</button>
                    <button type="submit" class="btn btn-primary" data-dismiss="modal" wire:click="deleteBulk">{{ __('Save') }}</button>
                </div>
        </div>
    </div>
</div>
