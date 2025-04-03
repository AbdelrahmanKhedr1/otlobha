<div class="col-12 pe-5 ps-5 pt-3 pb-3">

    <div class="input-group mb-3 mt-3">
        <div class="col-8 pe-1">
            <input type="text" wire:model.defer="query" class="form-control" placeholder="البحث عم وحدة . . .">
        </div>

        <div class="col-4 d-flex">
            <div class="col-4 pe-1 ps-1">
                <button wire:click="search" class="btn btn_tawrid me-1 w-100"><i class="fa fa-search"></i> </button>
            </div>
            <div class="col-4 pe-1 ps-1">
                <button wire:click="resetSearch" class="btn btn_tawrid me-1 w-100"><i class="fa fa-refresh"></i>
                </button>
            </div>
            <div class="col-4 pe-2">
                <a href="{{ route('unit.create', $item->id) }}" class="btn btn-primary w-100"
                    style="border-radius: 5px"><i class="fa fa-plus"></i> اضافة</a>
            </div>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="position-fixed top-0 start-50 translate-middle-x mt-3 auto-hide-alert" style="z-index: 1050;">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
            </div>
        </div>
    @endif
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
                <th class="control_th" scope="col"></th>
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

                        <div style="float:left">
                            <button class="btn btn-light" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                style="border: none; background: none; padding: 5px;">
                                <i class="fas fa-ellipsis-v color_i"></i>
                            </button>
                            <ul class="dropdown-menu ul_drop " aria-labelledby="dropdownMenuButton">
                                <li style="font-size: 12px;">
                                    <a style="text-decoration:none;" href="{{ route('unit.edit', $unit->id) }}">
                                        <button class="dropdown-item drop_select">تعديل</button>
                                    </a>
                                </li>
                                <li style="font-size: 12px;">
                                    <a style="text-decoration:none;" href="{{ route('image-unit.index', $unit->id) }}">
                                        <button class="dropdown-item drop_select">الصور</button>
                                    </a>
                                </li>
                                <li style="font-size: 12px;">
                                    <a style="text-decoration:none;" href="{{ route('unit.show', $unit->id) }}">
                                        <button class="dropdown-item drop_select">عرض</button>
                                    </a>
                                </li>
                                <li style="font-size: 12px;">
                                    <button class="dropdown-item drop_select"
                                        wire:click="$dispatch('deleteItem', { model: 'Unit', id: {{ $unit->id }} })"
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
                    <td colspan="12" style="text-align: center;">لا يوجد اصناف</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $units->links() }}

</div>
