<div class="col-12 pe-5 ps-5 pt-3 pb-3">
    <div class="input-group mt-3 ">
        <div class="col-5 input_div">
            <input type="date" wire:model.defer="startDate"class="input-search2 date_search form-control w-100"
                id="startDate">
            <span>الفترة من . . .</span>
        </div>
        <div class="col-5 input_div pe-1">
            <input type="date" wire:model.defer="endDate" class="input-search2 date_search form-control w-100"
                id="endDate">
            <span>الفترة إلى . . .</span>
        </div>
        <div class="col-2 d-flex">

            <div class="w-50 ps-1 pe-1">
                <button wire:click="searchPayments" class="btn_tawrid btn me-1 w-100"><i
                        class="fa fa-search"></i></button>
            </div>

            <div class="w-50 ps-1 pe-1">
                <button wire:click="resetSearch" style="border-radius: 5px" class="btn_tawrid btn me-1 w-100"><i
                        class="fa fa-refresh"></i></button>
            </div>

        </div>
    </div>
    <table class="table table-bordered text-center mt-3">
        <thead style="background: #f4f4f4;">
            <tr>
                <th scope="col">رقم الطلب</th>
                <th scope="col">تاريخ الطلب</th>
                <th scope="col">الاجمالي</th>
                <th scope="col">العميل</th>
            </tr>

        </thead>
        <tbody style="border-top:1px solid grey; ">
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
