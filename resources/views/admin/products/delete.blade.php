<div class="modal fade" id="delete{{ $info->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">delete info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('settings.Are_you_sure_to_delete_the_section?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('settings.Close') }}</button>
                <button wire:click='delete({{ $info }})' type="button" class="btn btn-primary" data-dismiss="modal">{{ __('settings.yes') }}</button>
            </div>
        </div>
    </div>
</div>
