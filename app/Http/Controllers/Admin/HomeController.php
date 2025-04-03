<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Store;
use App\Models\subscription;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){

        $storeCount = Store::count();
        $customerCount = Customer::count();
        $totalSummation = Order::sum('summation');
        $totalSummationSub = subscription::sum('summation');

        // جلب عدد الطلبات (المبيعات) لكل شهر بناءً على الحقل `time`
        $salesData = Order::select(
            DB::raw('MONTH(time) as month'),
            DB::raw('COUNT(*) as total_orders')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('total_orders', 'month')
        ->toArray();

        // تحويل المفاتيح إلى أسماء الأشهر
        $monthNames = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

        $formattedSalesData = [];
        foreach ($salesData as $month => $totalOrders) {
            $formattedSalesData[$monthNames[$month]] = $totalOrders;
        }

        return view('dashboard.index', compact('storeCount', 'customerCount', 'totalSummation','totalSummationSub', 'formattedSalesData'));
    }
}
