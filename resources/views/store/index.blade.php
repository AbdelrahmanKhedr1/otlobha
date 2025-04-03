@extends('store.master')
@section('title', 'الرئيسيه')
@section('home-active', 'active')
@section('content')

<div class="container-fluid">
        <div class="row col-12 mt-2">
            <div class="col-lg-3 col-md-6 col-sm-12 card card_div">
                <div class="row">
                    <div class="col-4">
                        <div class="i_card">
                            <div class="i_card2 card">
                                <i class="fa fa-users icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="mt-2" style="text-align:right;">
                            <p class="mb-0" style="color: #777;">اجمالي المشتركين :</p>
                        </div>
                        <div style="text-align:right;">
                            <p style="font-weight:bold;"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 card card_div">
                <div class="row">
                    <div class="col-4">
                        <div class="i_card">
                            <div class="i_card2 card">
                                <i class="fa fa-shopping-cart icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="mt-2" style="text-align:right;">
                            <p class="mb-0" style="color: #777;">عدد ال customer :</p>
                        </div>
                        <div style="text-align:right;">
                            <p style="font-weight:bold;"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 card card_div">
                <div class="row">
                    <div class="col-4">
                        <div class="i_card">
                            <div class="i_card2 card">
                                <i class="fa fa-table icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="mt-2" style="text-align:right;">
                            <p class="mb-0" style="color: #777;">اجمالي المبيعات :</p>
                        </div>
                        <div style="text-align:right;">
                            <p style="font-weight:bold;"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 card card_div">
                <div class="row">
                    <div class="col-4">
                        <div class="i_card">
                            <div class="i_card2 card">
                                <i class="fa fa-bell icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="mt-2" style="text-align:right;">
                            <p class="mb-0" style="color: #777;">اجمالي الاشتراكات :</p>
                        </div>
                        <div style="text-align:right;">
                            <p style="font-weight:bold;"></p>
                        </div>
                    </div>
                </div>
            </div>




        </div>


    <!-- ============================Charts=================================================== -->
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#notificationModal">
        عرض الإشعار
    </button>
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">إشعار جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    @foreach (Auth::user()->notifications as $notification)
                        <p>

                            {{ $notification->data['message'] .' =====  ' . $notification->data['name'] . ' ==== '. $notification->created_at->diffForHumans() }}
                        </p>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div> --}}

        <div class="row col-lg-12 mt-3">
            <div class="col-8 card card_chart">
                <div class="chart-container">
                    <div id="chart"></div>
                </div>
            </div>
            <div class="col-4 card card_chart">
                <div class="chart-container">
                    <div id="chartContainer"></div>
                </div>
            </div>
        </div>
</div>
@endsection
@section('script')
    <script>

        var options = {
            series: [{
                name: "المبيعات",
                data: [10, 20, 15, 25, 30, 40, 35]
            }],
            chart: {
                type: 'area',
                height: 350
            },
            xaxis: {
                categories: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو']
            }
        };
        
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var chartOptions = {
          series: [
          {
            name: 'الإيرادات',
            data: [44000, 55000, 41000, 67000, 22000, 43000, 32000, 45000, 38000]
          },
          {
            name: 'المصروفات',
            data: [48000, 50000, 40000, 65000, 25000, 40000, 30000, 42000, 35000]
          }
        ],
          chart: {
          type: 'bar',
          height: 350,
          stacked: true,
        },
        stroke: {
          width: 1
        },
        dataLabels: {
          formatter: (value) => {
            return value / 1000 + ' ألف'
          }
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '40%' // تصغير عرض العمود
          }
        },
        xaxis: {
          categories: [
            'الإعلانات عبر الإنترنت',
            'تدريب المبيعات',
            'الإعلانات المطبوعة',
            'الكتيبات',
            'الاجتماعات',
            'العلاقات العامة',
            'التسويق الرقمي',
            'تحليل البيانات',
            'إدارة المشاريع'
          ]
        },
        fill: {
          opacity: 1
        },
        yaxis: {
          labels: {
            formatter: (value) => {
              return value / 1000 + ' ألف'
            }
          }
        },
        legend: {
          position: 'top',
          horizontalAlign: 'right'
        }
        };

        var budgetChart = new ApexCharts(document.querySelector("#chartContainer"), chartOptions);
        budgetChart.render();
    </script>
@endsection
