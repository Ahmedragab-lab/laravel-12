<div class="modal fade" id="delete{{ $info->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('shiftes.destroy', $info->id) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    {{ __('settings.Are_you_sure_to_delete_the_section?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('settings.Close') }}</button>
                    <button type="submit" class="btn btn-primary" >{{ __('settings.yes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

