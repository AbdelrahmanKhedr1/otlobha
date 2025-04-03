<div>
    <button wire:click="toggleStatus" class="btn {{ $city->status == 0 ? 'btn-danger' : 'btn-success' }} btn-sm">
        {{ $city->status == 0 ? 'تفعيل' : 'إلغاء التفعيل' }}
    </button>
</div>
