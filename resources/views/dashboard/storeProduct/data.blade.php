<div style="position: relative;" class="col-12 pe-5 ps-5 pt-3 pb-3">

    <div class="input-group mt-3 ">
        <div class="col-10">
            <div class="col-12 ps-3 ">
                <input type="text" class="form-control " wire:model='search' placeholder="ابحث عن منتج..."
                    aria-label="ابحث عن منتج">
            </div>
            <div class="col-12 mt-2 ps-3">
                <div class="row">
                    <div class="col-6 input_div">
                        <input type="date"
                            wire:model.defer="startDate"class="input-search2 date_search form-control w-100"
                            id="startDate">
                        <span>الفترة من . . .</span>
                    </div>
                    <div class="col-6 input_div">
                        <input type="date" wire:model.defer="endDate"
                            class="input-search2 date_search form-control w-100" id="endDate">
                        <span>الفترة إلى . . .</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-2">

            <div class="col-12 ">
                <button wire:click="resetSearch" class="btn btn_tawrid w-100"><i class="fa fa-refresh"></i></button>
            </div>
            <div class="col-12 mt-2">
                <button wire:click="searchPayments" style="border-radius: 5px" class="btn btn_tawrid w-100"><i
                        class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
    <table class="table table-bordered text-center mt-3">
        <thead style="background: #f4f4f4;">
            <tr>
                <th scope="col">الاسم</th>
                <th scope="col">الوصف</th>
                <th scope="col">الصوره</th>
                <th scope="col">التحكم</th>
            </tr>
        </thead>
        <tbody style="border-top:1px solid grey; ">
            @forelse ($items as $item)
                <tr>
                    <td>{{ $item->product->title }}</td>
                    <td>{{ $item->product->description }}</td>
                    <td>
                        @if ($item->product->image)
                            <img src="{{ asset($item->product->image) }}" alt="" width="100px">
                        @endif
                    </td>
                    <td style="display: flex; justify-content:center;">
                        <a style="text-decoration:none;" href="{{ route('store.unit', $item->id) }}">
                            <button class="btn btn-outline-success btn-sm m-1">الوحدات</button>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">لا يوجد منتجات
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $items->links() }}
</div>
