@props(['name', 'route'])

<button style="text-decoration:none;" class="dropdown-item drop_select" data-bs-toggle='modal'
    data-bs-target='#exampleModal{{ $name->id }}'>
    حذف
</button>

<div wire:ignore class="modal fade" id="exampleModal{{ $name->id }}" tabindex="-1" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                هل انت متأكد من حذف {{ $name->title ?? $name->name_ar }}؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm m-1" data-bs-dismiss="modal">لا</button>
                <button type="submit" class="btn btn-outline-danger btn-sm m-1"
                    wire:click="delete({{ $name->id }})" data-bs-dismiss="modal">حذف</button>
            </div>
        </div>
    </div>
</div>
