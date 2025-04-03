<div class="col-12 pe-5 ps-5 pt-3 pb-3">
    <div class="input-group">
        <div class="col-12 mb-2">
            <a style="float:left;" href="{{ route('dashoffer.create') }}">
                <button style="border-radius: 5px;" class="btn btn-primary me-1">اضافة اعلان +</button>
            </a>
        </div>
    </div>
    <table class="table table-bordered text-center">
        <thead style="background: #f4f4f4;">
            <tr>
                <th scope="col">اسم الاعلان</th>
                <th scope="col">الوصف</th>
                <th scope="col">الصوره</th>
                <th class="control_th   " scope="col"></th>
            </tr>
        </thead>
        <tbody style="border-top:1px solid grey; ">
            @foreach ($dashOffers as $dashOffer)
                <tr>
                    <td>{{ $dashOffer->title }}</td>
                    <td>{{ $dashOffer->description }}</td>

                    <td><img style="width: 100px;" src="{{ asset($dashOffer->image) }}" alt=""></td>

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
                                        href="{{ route('dashoffer.edit', $dashOffer->id) }}">
                                        <button class="dropdown-item drop_select">تعديل</button>
                                    </a>
                                </li>
                                <li style="font-size: 12px;">
                                    <button class="dropdown-item drop_select"
                                        wire:click="$dispatch('deleteItem', { model: 'DashboardOffer', id: {{ $dashOffer->id }} })"
                                        data-bs-toggle="modal" data-bs-target="#Modal_delete">
                                        حذف
                                    </button>
                                </li>



                            </ul>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $dashOffers->links() }}

</div>
