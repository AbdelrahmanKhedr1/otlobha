<div class="col-12 pe-5 ps-5 pt-3 pb-3">

    <div class="input-group mt-3 ">
        <div class="col-10">
            <div class="col-12 ps-4 ">
                <input type="text" class="form-control " wire:model.defer="search"
                    placeholder="ابحث عن {{ $category->name }} . . ." aria-label="ابحث عن {{ $category->name }}">
            </div>
            <div class="col-12 mt-2 row">
                <div class="col-6 input_div">
                    <input type="date" wire:model.defer="startDate"class="input-search2 date_search form-control w-100" id="startDate">
                    <span>الفترة من . . .</span>
                </div>
                <div class="col-6 input_div">
                    <input type="date" wire:model.defer="endDate" class="input-search2 date_search form-control w-100" id="endDate">
                    <span>الفترة إلى . . .</span>
                </div>
            </div>
        </div>

        <div class="col-2">

            <div class="col-12">
                <button wire:click="resetSearch" style="border-radius: 5px"
                    class="btn btn_tawrid w-100"><i class="fa fa-refresh"></i></button>
            </div>
            <div class="col-12 mt-2">
                <button wire:click="searchStores" class="btn btn_tawrid w-100"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>

    <table class="table table-bordered text-center mt-3">
        <thead style="background: #f4f4f4;">
            <tr>
                <th scope="col">اسم
                    ال{{ $category->name }}</th>
                <th scope="col">العنوان</th>
                <th scope="col">رقم الهاتف</th>
                <th class="control_th" scope="col"></th>
            </tr>
        </thead>
        <tbody style="border-top:1px solid grey; ">
            @forelse ($stores as $store)
                <tr>
                    <td>{{ $store->name }}</td>
                    <td>{{ $store->address }}</td>
                    <td>{{ $store->mobile }}</td>
                    <td>

                        <div style="float:left">
                        <button class="btn btn-light" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-expanded="false" style="border: none; background: none; padding: 5px;">
                        <i class="fas fa-ellipsis-v color_i"></i>
                      </button>
                      <ul class="dropdown-menu ul_drop " aria-labelledby="dropdownMenuButton">
                        <li style="font-size: 12px;">
                            <a href="{{ route('store.show', $store->id) }}">
                                                    <button style="border-radius: 5px;"
                                                        class="dropdown-item drop_select">بيانات
                                                        {{ $store->name }}</button>
                                                </a>
                        </li>
                        <li style="font-size: 12px;">
                            <a href="{{ route('store.product', $store->id) }}">
                                <button style="border-radius: 5px;"class="dropdown-item drop_select">المنتجات</button>
                            </a>
                        </li>

                        <li style="font-size: 12px;">
                            <a href="{{ route('payment.index', $store->id) }}">
                                <button style="border-radius: 5px;"class="dropdown-item drop_select">التوريدات</button>
                            </a>
                        </li>
                        <li style="font-size: 12px;">
                            <a href="{{ route('store.order', $store->id) }}">
                                <button style="border-radius: 5px;"class="dropdown-item drop_select">المبيعات</button>
                            </a>
                        </li>

                      </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">لا يوجد {{ $category->title }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $stores->links() }}
</div>
