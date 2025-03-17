<div wire:ignore.self class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">قسم جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>اسم القسم<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" wire:model.live="new_category_name">
                    @error('new_category_name')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label class="small-label" for="">
                            image
                            <span class="text-danger">*</span>
                        </label>
                        <div class="box-input">
                            <input type="file" class="form-control" wire:model='new_category_image' id="" />
                        </div>
                        <div class="box-input">
                            <div class="col-md-3">
                                @if ($new_category_image instanceof \Illuminate\Http\UploadedFile)
                                    <img src="{{ $new_category_image->temporaryUrl() }}" class="img-thumbnail" width="100" />
                                @elseif (is_string($new_category_image) && !empty($new_category_image))
                                    <img src="{{ display_file($new_category_image) }}" class="img-thumbnail" width="100" />
                                @else
                                    <img src="{{ asset('no-image.jpg') }}" class="img-thumbnail" width="100" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add more category fields if needed -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-dismiss="modal">@lang('site.close')</button>
                <button type="button" class="btn btn-primary" wire:click="saveCategory" data-dismiss="modal">@lang('site.save')</button>
            </div>
        </div>
    </div>
</div>
