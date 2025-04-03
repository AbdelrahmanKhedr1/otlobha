<div class="modal fade" wire:ignore.self id="Modal_edit_company" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="text-center fs-5 ">تعديل بيانات الشركة</h5>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">اسم الشركة</label>
                        <input type="text" id="edit_title" class="form-control" wire:model="title">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="btn_div">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal">حفظ
                            التعديلات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
