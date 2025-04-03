<div>
    <div class="col-12 pe-5 ps-5 pt-3 pb-3">

        <div class="input-group mt-3">
            <div class="col-9 pe-1">
                <input type="text" wire:model.defer="query" class="form-control" placeholder="البحث عن اسم منتج . . .">
            </div>

            <div class="col-3 d-flex">
                <div class="col-3 pe-1">
                    <button wire:click="search" class="btn btn_tawrid me-1 w-100"><i class="fa fa-search"></i> </button>
                </div>
                <div class="col-3 pe-1">
                    <button wire:click="resetSearch" class="btn btn_tawrid me-1 w-100"><i class="fa fa-refresh"></i>
                    </button>
                </div>
                <div class="col-6 pe-1">
                    <a href="{{ route('product.create') }}">
                        <button class="btn btn-primary me-1 w-100" style="border-radius: 5px"> منتج +</button>
                    </a>
                </div>
            </div>
        </div>

        <table class="table table-bordered text-center mt-3">
            <thead style="background: #f4f4f4;">
                <tr>
                    <th scope="col">الاسم</th>
                    <th scope="col">الوصف</th>
                    <th scope="col">الشركة المصنعة</th>
                    <th class="control_th" scope="col"></th>
                </tr>
            </thead>
            <tbody style="border-top:1px solid grey;">
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->company->title ?? 'لا يوجد' }}</td>
                        <td>
                            <div style="float:left">
                                <button class="btn btn-light" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false"
                                    style="border: none; background: none; padding: 5px;">
                                    <i class="fas fa-ellipsis-v color_i"></i>
                                </button>
                                <ul class="dropdown-menu ul_drop " aria-labelledby="dropdownMenuButton">
                                    <li style="font-size: 12px;">
                                        <a style="text-decoration:none;"
                                            href="{{ route('product.edit', $product->id) }}">
                                            <button class="dropdown-item drop_select">تعديل</button>
                                        </a>
                                    </li>
                                    <li style="font-size: 12px;">
                                        <button class="dropdown-item drop_select"
                                            wire:click="$dispatch('deleteItem', { model: 'Product', id: {{ $product->id }} })"
                                            data-bs-toggle="modal" data-bs-target="#Modal_delete">
                                            حذف
                                        </button>
                                    </li>
                                </ul>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">لا توجد نتائج.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
</div>
