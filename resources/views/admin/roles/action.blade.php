<a href="{{ route('roles.edit', $info->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
<button type="button" class="btn btn-sm btn-danger"
    data-toggle="modal" data-target="#delete{{ $info->id }}">
    <i class="fa fa-trash"></i>@lang('site.delete')
</button>


<div class="modal fade" id="delete{{ $info->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('roles.destroy', $info->id) }}" method="POST">
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
