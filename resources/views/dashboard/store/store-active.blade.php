<div class="col-6">
    <button style="float:left;" wire:click="toggleActive" class="w-50 btn btn-sm {{ $store->active == 1 ? 'btn-outline-success' : 'btn-outline-danger' }}">
        {{ $store->active == 1 ? 'مفعل' : 'معطل' }}
    </button>
</div>
