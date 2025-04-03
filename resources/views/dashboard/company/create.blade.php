<div class="modal fade" id="Modal_create_company" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <ul class="list-group ">
                    <div class="text-center col-12">
                        <p> اضافه شركه </p>
                    </div>
                    <div style="border-top: 1px solid #d6d6d6;">
                        <form wire:submit.prevent="save" method="POST" class="mt-3 col-lg-12 col-sm-12" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 col-12">
                                <input type="text" id="title" class="form-control" wire:model="title" placeholder="اسم الشركه">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit"  class="form-control btn btn-primary col-12 " data-bs-dismiss="modal"> اضافه </button>
                        </form>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
