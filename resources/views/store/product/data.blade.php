<div class="col-12 pe-5 ps-5 pt-3 pb-3">
    <div class="input-group mt-3">
        <div class="col-10 pe-1">
            <input type="text" wire:model.debounce.500ms="query" class="form-control" placeholder="البحث عن منتج . . .">
        </div>
        <div class="col-2 d-flex">
            <div class="col-6 input_div pe-1">
                <button wire:click="search" class="btn btn_tawrid w-100"><i class="fa fa-search"></i></button>
            </div>
            <div class="col-6 input_div">
                <button wire:click="resetSearch" class="btn btn_tawrid w-100"><i class="fa fa-refresh"></i></button>
            </div>
        </div>
    </div>

    <div class="d-flex mt-3 mb-3" style="float: left;">
        @if ($showAvailableProducts && $products->count() > 0)
            <button wire:click="toggleSelectAll" class="btn btn-info ms-1 btn-sm">
                {{ $selectAll ? 'إلغاء التحديد' : 'تحديد الكل' }}
            </button>
        @endif

        @if ($showAvailableProducts)
            <button wire:click="addSelectedProducts" class="btn btn-success ms-1 btn-sm"
                    wire:loading.attr="disabled"
                    wire:target="addSelectedProducts"
                    {{-- {{ count($selectedProducts) ? '' : 'disabled' }} --}}
                    >
                إضافة المنتجات المحددة
            </button>
        @endif

        <button wire:click="toggleShowAvailable" class="btn btn-primary btn-sm">
            {{ $showAvailableProducts ? 'عرض المنتجات لديك' : 'عرض المنتجات المتاحة للإضافة' }}
        </button>
    </div>

    @if (session()->has('message'))
        <div class="position-fixed top-0 start-50 translate-middle-x mt-3 auto-hide-alert" style="z-index: 1050;">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
            </div>
        </div>
    @endif

    <table class="table table-bordered text-center mt-3">
        <thead style="background: #f4f4f4;">
            <tr>
                @if ($showAvailableProducts)
                    <th scope="col">
                        <input type="checkbox" wire:model="selectAll" wire:click="toggleSelectAll">
                    </th>
                @endif
                <th scope="col">اسم المنتج</th>
                @if (!$showAvailableProducts)
                    <th class="control_th" scope="col"></th>
                @endif
            </tr>
        </thead>
        <tbody style="border-top: 1px solid grey;">
            @forelse ($products as $product)
                <tr>
                    @if ($showAvailableProducts)
                        <td>
                            <input type="checkbox" wire:model="selectedProducts" value="{{ $product->id }}">
                        </td>
                    @endif
                    <td>{{ $product->title }}</td>
                    @if (!$showAvailableProducts)
                        <td>
                            <div style="float: left;">
                                <button class="btn btn-light" type="button" id="dropdownMenuButton{{ $this->getItemId($product->id) }}"
                                        data-bs-toggle="dropdown" aria-expanded="false"
                                        style="border: none; background: none; padding: 5px;">
                                    <i class="fas fa-ellipsis-v color_i"></i>
                                </button>
                                <ul class="dropdown-menu ul_drop" aria-labelledby="dropdownMenuButton{{ $this->getItemId($product->id) }}">
                                    <li style="font-size: 12px;">
                                        <a href="{{ route('unit.index', $this->getItemId($product->id)) }}">
                                            <button class="dropdown-item drop_select">الوحدات</button>
                                        </a>
                                    </li>

                                    <li style="font-size: 12px;">
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $this->getItemId($product->id) }}">
                                            <button class="dropdown-item drop_select">التاجز</button>
                                        </a>
                                    </li>
                                    <li style="font-size: 12px;">
                                        <button class="dropdown-item drop_select"
                                                wire:click="$dispatch('deleteItem', { model: 'Item', id: {{ $this->getItemId($product->id) }} })"
                                                data-bs-toggle="modal" data-bs-target="#Modal_delete">
                                            حذف
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            @livewire('store.item.tag', ['itemId' => $this->getItemId($product->id)], key($product->id))
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $showAvailableProducts ? '2' : '3' }}" style="text-align: center;">
                        لا توجد نتائج.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $products->links() }}
</div>
