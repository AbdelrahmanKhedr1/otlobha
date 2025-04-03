<div class="container text-center">
    @if (session()->has('message'))
        <div class="position-fixed top-0 start-50 translate-middle-x mt-3 auto-hide-alert" style="z-index: 1050;">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
            </div>

        </div>
    @endif


    <div class="modal fade" id="exampleModal{{ $item_id }}" tabindex="-1" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title">إدارة التاجات للمنتج: {{ $productTitle }}</h5>
                </div>
                <div class="modal-body row">
                    <form>
                        @foreach ($allTags as $tag)
                            <div class="form-check">
                                <input type="checkbox" wire:model="tags" value="{{ $tag->id }}"
                                    class="form-check-input">
                                <label class="form-check-label">{{ $tag->name_ar . '  =>  ' . $tag->name_en }}</label>

                            </div>
                        @endforeach
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="button" wire:click="syncTags" class="btn btn-primary"
                        data-bs-dismiss="modal">تحديث</button>
                </div>
            </div>
        </div>
    </div>
</div>
