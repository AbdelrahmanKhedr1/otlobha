<div style="position: relative;" class="col-12 pe-5 ps-5 pt-3 pb-3">
    <h2 style="text-align: center;">عروض {{ $store->category->name }} {{ $store->name }}</h2>
    <div class="input-group">
        <input type="text" wire:model.live='search' class="form-control" placeholder="البحث عن عرض . . . ">
        <a href="{{ route('offer.create') }}">
            <button style="border-radius: 5px" class="btn btn-primary me-1">اضافة عرض</button>
        </a>
    </div>
    <table class="table table-bordered text-center mt-2">
        <thead style="background: #f4f4f4;">
            <tr>
                <th scope="col">الاسم</th>
                <th scope="col">الوصف</th>
                <th class="control_th" scope="col"></th>
            </tr>
        </thead>
        <tbody style="border-top:1px solid grey; ">
            @forelse ($offers as $offer)
                <tr>
                    <td>{{ $offer->title }}</td>
                    <td>{{ $offer->description }}</td>
                    <td>
                        <div style="float:left">
                            <button class="btn btn-light" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                style="border: none; background: none; padding: 5px;">
                                <i class="fas fa-ellipsis-v color_i"></i>
                            </button>
                            <ul class="dropdown-menu ul_drop " aria-labelledby="dropdownMenuButton">
                                <li style="font-size: 12px;">
                                    <a href="{{ route('image-offer.index', $offer->id) }}">
                                        <button style="border-radius: 5px;" class="dropdown-item drop_select">صور
                                            العرض</button>
                                    </a>
                                </li>
                                <li style="font-size: 12px;">
                                    <a href="{{ route('offer.edit', $offer->id) }}">
                                        <button style="border-radius: 5px;"
                                            class="dropdown-item drop_select">تعديل</button>
                                    </a>
                                </li>

                                <li style="font-size: 12px;">
                                    <a href="{{ route('offer.show', $offer->id) }}">
                                        <button style="border-radius: 5px;"
                                            class="dropdown-item drop_select">عرض</button>
                                    </a>
                                </li>
                                <li style="font-size: 12px;">
                                    <button class="dropdown-item drop_select"
                                        wire:click="$dispatch('deleteItem', { model: 'Offer', id: {{ $offer->id }} })"
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
                    <td colspan="4" style="text-align: center;">لا يوجد عروض
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $offers->links() }}
</div>
