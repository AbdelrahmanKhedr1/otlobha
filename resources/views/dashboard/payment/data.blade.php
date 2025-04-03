<div style="position: relative;" class="col-12 pe-5 ps-5 pt-3 pb-3">
    <div class="input-group mt-3 ">
        {{-- <div class="col-5">
            <input type="date" wire:model.defer="startDate" class="form-control">
        </div>
        <div class="col-5 pe-1">
            <input type="date" wire:model.defer="endDate" class="form-control">
        </div> --}}
        <div class="col-5 input_div ">
            <input type="date" wire:model.defer="startDate"class="input-search2 date_search form-control w-100" id="startDate">
            <span>الفترة من . . .</span>
        </div>
        <div class="col-5 input_div pe-1">
            <input type="date" wire:model.defer="endDate" class="input-search2 date_search form-control w-100" id="endDate">
            <span>الفترة إلى . . .</span>
        </div>
        <div class="col-2 d-flex">
            <div class="col-2">
                <button wire:click="searchPayments" class="btn_tawrid btn me-1"><i class="fa fa-search"></i>
                </button>
            </div>

            <div class="col-2 pe-2">
                <button wire:click="resetSearch" style="border-radius: 5px" class="btn_tawrid btn me-1"><i
                        class="fa fa-refresh"></i>
                </button>
            </div>
            <div class="col-8 pe-3">
                <a href="{{ route('payment.create', $store->id) }}">
                    <button style="border-radius: 5px" class="btn btn-primary me-1 w-100">توريد+</button>
                </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered text-center mt-3">
        <thead style="background: #f4f4f4;">
            <tr>
                <th scope="col">رقم العمليه</th>
                <th scope="col">المبلغ</th>
                <th scope="col">تاريخ العمليه</th>
                <th scope="col">ملاحظه</th>
                <th class="control_th" scope="col"></th>
            </tr>
        </thead>
        <tbody style="border-top:1px solid grey; ">
            @forelse ($payments as $payment)
                <tr>

                    <td>{{ $payment->num_process }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->date }}</td>
                    <td>{{ $payment->note }}</td>
                    <td>
                        <button class="btn btn-light" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                            aria-expanded="false" style="border: none; background: none; padding: 5px; float:left;">
                            <i class="fas fa-ellipsis-v color_i"></i>
                        </button>
                        <ul class="dropdown-menu ul_drop " aria-labelledby="dropdownMenuButton">
                            <li style="font-size: 12px;">
                                <a href="{{ route('payment.edit', $payment->id) }}">
                                    <button style="border-radius: 5px;"class="dropdown-item drop_select">تعديل</button>
                                </a>
                            </li>
                            <li style="font-size: 12px;">
                                <button class="dropdown-item drop_select"
                                    wire:click="$dispatch('deleteItem', { model: 'Payment', id: {{ $payment->id }} })"
                                    data-bs-toggle="modal" data-bs-target="#Modal_delete">
                                    حذف
                                </button>
                            </li>
                        </ul>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">لا يوجد عمليات دفع </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $payments->links() }}
</div>
