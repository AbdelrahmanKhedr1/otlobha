<div class="col-12 pe-5 ps-5 pt-3 pb-3">
    <div class="col-12 pe-5 ps-5 pt-3 pb-3">
        <div class="input-group">
            <input type="text" wire:model.live='search' class="form-control" placeholder="ابحث عن مشترك..."
                aria-label="ابحث عن مطعم">
            <a href="{{ route('subscription.create') }}">
                <button style="border-radius: 5px" class="btn btn-outline-secondary me-1">إضافة اشتراك</button>
            </a>
            <a href="{{ route('subscription.endSub') }}">
                <button style="border-radius: 5px" class="btn btn-outline-danger me-1">الغير مشتركين </button>
            </a>
        </div>
        <table class="table table-bordered text-center">
            <thead style="background: #f4f4f4;">
                <tr>
                    <th scope="col">الاسم</th>
                    <th scope="col">بداية الاشتراك</th>
                    <th scope="col">نهاية الاشتراك</th>
                    <th scope="col">قيمه الاشتراك</th>
                    <th scope="col">نوع الخدمة</th>
                    <th scope="col">التحكم</th>

                </tr>
            </thead>
            <tbody style="border-top:1px solid grey; ">
                @foreach ($subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->store->name }}</td>
                        <td>{{ $subscription->start_at }}</td>
                        <td>{{ $subscription->end_at }}</td>
                        <td>{{ $subscription->summation }}</td>
                        <td>{{ $subscription->store->category->title }}</td>
                        <td style="display: flex; justify-content:center;">
                            <a style="text-decoration:none;" href="{{ route('subscription.edit', $subscription->id) }}">
                                <button class="btn btn-outline-primary btn-sm m-1">تعديل</button>
                            </a>
                            <form action="{{ route('subscription.destroy', $subscription->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <a style="text-decoration:none;" href="">
                                    <button class="btn btn-outline-danger btn-sm m-1">حذف</button>
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>

    </div>

</div>
