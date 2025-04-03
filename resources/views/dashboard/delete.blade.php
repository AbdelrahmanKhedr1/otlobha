<div wire:ignore.self class="modal fade" id="Modal_delete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5">تأكيد الحذف</h5>

            </div>
            <div class="modal-body">
                هل أنت متأكد من الحذف؟
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-danger btn-sm" wire:click="delete" data-bs-dismiss="modal">
                    حذف
                </button>
            </div>
        </div>
    </div>
</div>

