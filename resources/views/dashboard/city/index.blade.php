@extends('dashboard.master')
@section('title', 'المحافظات')
@section('city-active', 'active')
@section('content')
    <div class="col-12 pe-5 ps-5 pt-3 pb-3">
        <table class="table table-bordered text-center">
            <thead style="background: #f4f4f4;">
                <tr>
                    <th scope="col">اسم المحافظه</th>
                    <th class="control_th_con" scope="col"></th>
                </tr>
            </thead>
            <tbody style="border-top:1px solid grey; ">
                @foreach ($citys as $city)
                    <tr>
                        <td>{{ $city->city }}</td>
                        <td>
                            <livewire:dashboard.city.data :city="$city" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
