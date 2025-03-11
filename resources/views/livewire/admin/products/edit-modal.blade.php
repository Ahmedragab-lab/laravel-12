<!-- مودال التعديل -->
<div wire:ignore.self class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">تعديل المنتج</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" class="form-control" wire:model="name">
                </div>

                <div class="form-group">
                    <label>الوصف</label>
                    <textarea class="form-control" wire:model="description"></textarea>
                </div>

                <div class="form-group">
                    <label>السعر</label>
                    <input type="number" class="form-control" wire:model="price">
                </div>

                <div class="form-group">
                    <label>القسم</label>
                    <select class="form-control" wire:model="category_id">
                        <option value="">اختر القسم</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>الماركة</label>
                    <select class="form-control" wire:model="brand_id">
                        <option value="">اختر الماركة</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- <button class="btn btn-primary" wire:click="submit" wire:loading.attr="disabled">تحديث</button> -->
                <button type="button" class="btn btn-primary" wire:click="submit" data-dismiss="modal">تحديث</button>

            </div>
        </div>
    </div>
</div>
