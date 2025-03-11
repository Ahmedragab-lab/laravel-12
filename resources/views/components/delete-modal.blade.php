
<button type="button" data-toggle="modal" data-target="#delete{{ $item->id }}" class="btn btn-sm btn-danger">
    <i class="fa fa-trash"></i>
</button>

<div class="modal fade" id="delete{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">حذف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                هل انت متاكد من الحذف ؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <button type="button" wire:click="delete({{$item->id}})" data-dismiss="modal" class="btn btn-danger">حذف</button>
            </div>
        </div>
    </div>
</div>
