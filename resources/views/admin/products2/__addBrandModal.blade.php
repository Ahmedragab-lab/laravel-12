<div wire:ignore.self class="modal fade" id="addbrandModal" tabindex="-1" role="dialog" aria-labelledby="addbrandModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addbrandModalLabel">براند جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>اسم البراند<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" wire:model.live="new_brand_name">
                    @error('new_brand_name')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label class="small-label" for="">
                            image
                            <span class="text-danger">*</span>
                        </label>
                        <div class="box-input">
                            <input type="file" class="form-control" wire:model='new_brand_image' id="" />
                        </div>
                        <div class="box-input">
                            <div class="col-md-3">
                                @if ($new_brand_image instanceof \Illuminate\Http\UploadedFile)
                                    <img src="{{ $new_brand_image->temporaryUrl() }}" class="img-thumbnail" width="100" />
                                @elseif (is_string($new_brand_image) && !empty($new_brand_image))
                                    <img src="{{ display_file($new_brand_image) }}" class="img-thumbnail" width="100" />
                                @else
                                    <img src="{{ asset('no-image.jpg') }}" class="img-thumbnail" width="100" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add more brand fields if needed -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-dismiss="modal">@lang('site.close')</button>
                <button type="button" class="btn btn-primary" wire:click="saveBrand" data-dismiss="modal">@lang('site.save')</button>
            </div>
        </div>
    </div>
</div>
