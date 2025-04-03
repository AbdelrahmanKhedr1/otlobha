<div class="col-12 pe-5 ps-5 pt-3 pb-3">

    <div class="input-group mb-3 mt-3">
        <div class="col-10 pe-1">
            <input type="text" wire:model.defer="query" class="form-control" placeholder="البحث عن اسم الوحدة . . .">
        </div>

        <div class="col-2">
            <div class="d-flex">
                <div class="col-6 pe-2">
                    <button wire:click="search" class="btn btn_tawrid w-100"><i class="fa fa-search"></i></button>
                </div>
                <div class="col-6 pe-2">
                    <button wire:click="resetSearch" class="btn btn_tawrid w-100"><i class="fa fa-refresh"></i></button>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered text-center">
        <thead style="background: #f4f4f4;">
            <tr>
                <th scope="col">الاسم</th>
                <th scope="col">السعر</th>
                <th scope="col">الوصف</th>
                <th scope="col">الخصم</th>
                <th scope="col">قيمة الخصم</th>
                <th scope="col">الضريبه</th>
                <th scope="col">تاريخ الانتاج</th>
                <th scope="col">تاريخ الانتهاء</th>
                <th scope="col">كميه المخزون</th>
                <th scope="col">الوقت المستغرق من</th>
                <th scope="col">الوقت المستغرق الي</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody style="border-top:1px solid grey;">
            @forelse ($units as $unit)
                <tr>
                    <td>{{ $unit->title }}</td>
                    <td>{{ $unit->price }}</td>
                    <td>{{ $unit->description }}</td>
                    <td>{{ $unit->is_percentage == 1 || $unit->is_percentage == 2 ? 'يوجد خصم' : 'لا يوجد خصم' }}</td>
                    <td>{{ $unit->is_percentage == 1 || $unit->is_percentage == 2 ? $unit->discount : 'لا يوجد خصم' }}
                    </td>
                    <td>{{ $unit->taxValue }}</td>
                    <td>{{ $unit->pro_date }}</td>
                    <td>{{ $unit->exp_date }}</td>
                    <td>{{ $unit->stock_quantity }}</td>
                    <td>{{ $unit->from_time }}</td>
                    <td>{{ $unit->to_time }}</td>
                    <td>
                    <button class="btn btn-light" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-expanded="false" style="border: none; background: none; padding: 5px; float:left;">
                        <i class="fas fa-ellipsis-v color_i"></i>
                      </button>
                      <ul class="dropdown-menu ul_drop " aria-labelledby="dropdownMenuButton">
                        <li style="font-size: 12px;">
                            <a href="{{ route('store.unit.image-unit', $unit->id) }}">
                                <button class="dropdown-item drop_select" data-bs-toggle="modal"
                                data-bs-target="#edit">الصور</button>
                            </a>
                        </li>
                        <li style="font-size: 12px;">
                            <a href="{{ route('store.unit.show', $unit->id) }}">
                                <button class="dropdown-item drop_select" data-bs-toggle="modal"
                                data-bs-target="#delete">عرض</button>
                            </a>
                        </li>
                      </ul>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" style="text-align: center;">لا يوجد اصناف</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $units->links() }}

</div>
