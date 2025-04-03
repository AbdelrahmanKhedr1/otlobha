<div class="col-12 pe-5 ps-5 pt-3 pb-3">
    <h2 style="text-align: center;">{{ $store->name }}</h2>

    <div class="input-group mt-3">
        <div class="col-10">
            <div class="col-12 ps-4">
                <input type="text" class="form-control" wire:model.defer="search"
                    placeholder="ابحث عن طلب . . . " aria-label="ابحث عن طلب">
            </div>
            <div class="col-12 mt-2 row">
                <div class="col-6 input_div">
                    <input type="date" wire:model.defer="startDate" class="input-search2 date_search form-control w-100" id="startDate">
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
                <button wire:click="resetSearch" style="border-radius: 5px" class="btn btn_tawrid w-100">
                    <i class="fa fa-refresh"></i>
                </button>
            </div>
            <div class="col-12 mt-2">
                <button wire:click="searchPayments" class="btn btn_tawrid w-100">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <table class="table table-bordered text-center mt-3">
        <thead style="background: #f4f4f4;">
            <tr>
                <th scope="col">رقم الطلب</th>
                <th scope="col">تاريخ الطلب</th>
                <th scope="col">الإجمالي</th>
                <th scope="col">العميل</th>
            </tr>
        </thead>
        <tbody style="border-top:1px solid grey;">
            @php
            $i = $orders->count();
            @endphp
            @foreach ($orders as $order)
            <tr>
                <td>{{ $i-- }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->summation }}</td>
                <td>{{ $order->customer->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>