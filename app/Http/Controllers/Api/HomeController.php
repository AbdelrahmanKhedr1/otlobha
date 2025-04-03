<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DistanceHelper;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DashboardOffer;
use App\Models\Item;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function dashboardOffer()
    {
        $dashboardOffer = DashboardOffer::all();

        if ($dashboardOffer->count() > 0) {
            return response()->json([
                'data' => $dashboardOffer,
                'message' => 'DashboardOffer found successfully',
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'DashboardOffer not found.',
                'status' => 404,
            ], 404);
        }
    }


    public function search(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ]);

        $lat = $request->lat;
        $lng = $request->lng;

        $query = Product::where('title', 'like', '%' . $request->title . '%')
            ->whereHas('item.store')
            ->with(['item.store']);

        if (!is_null($lat) && !is_null($lng)) {
            $query = DistanceHelper::filterByDistance($query, $lat, $lng, 'item.store');
        }

        $products = $query->paginate(5);

        return response()->json([
            'data' => $products,
            'message' => $products->isNotEmpty() ? 'Products found successfully.' : 'No products found.',
            'status' => $products->isNotEmpty() ? 200 : 404,
        ], $products->isNotEmpty() ? 200 : 404);
    }

    public function forYou()
    {

        $customer = Customer::findOrFail(Auth::id());

        $orderUnits = $customer->orderUnits()->with('unit.store')->get();

        // استخراج category_id من المتاجر التي اشترى منها العميل
        $categoryIds = $orderUnits->pluck('unit.store.category_id')->filter()->unique();

        // استخراج unit_ids التي اشتراها العميل لتجنب عرضها
        $purchasedUnitIds = $orderUnits->pluck('unit_id')->unique();

        // استرجاع المنتجات المشابهة بناءً على category_id
        $similarProducts = Unit::whereHas('store', function ($query) use ($categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        })
            // ->whereNotIn('id', $purchasedUnitIds) // تجنب المنتجات التي اشتراها العميل
            ->take(5)
            ->get();

        $topUnits = DB::table('order_units')
            ->select('unit_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('unit_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        $topUnitsWithDetails = Unit::whereIn('id', $topUnits->pluck('unit_id'))
            ->get()
            ->map(function ($unit) use ($topUnits) {
                $unit->total_sold = $topUnits->firstWhere('unit_id', $unit->id)->total_sold;
                return $unit;
            });

        if ($similarProducts->isNotEmpty()) {
            return response()->json([
                'data' => $similarProducts,
                'message' => 'Similar products found successfully',
                'status' => 200,
            ], 200);
        } else {

            return response()->json([
                'data' => $topUnitsWithDetails,
                'message' => 'Top Units found successfully',
                'status' => 200,
            ], 200);
        }
    }

    public function topUnits()
    {
        $topUnits = DB::table('order_units')
            ->select('unit_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('unit_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        $topUnitsWithDetails = Unit::whereIn('id', $topUnits->pluck('unit_id'))
            ->get()
            ->map(function ($unit) use ($topUnits) {
                $unit->total_sold = $topUnits->firstWhere('unit_id', $unit->id)->total_sold;
                return $unit;
            });
            
        return response()->json([
            'data' => $topUnitsWithDetails,
            'message' => 'Top Units found successfully',
            'status' => 200,
        ], 200);
    }


    public function newest(Request $request)
    {
        $request->validate([
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ]);

        $lat = $request->lat;
        $lng = $request->lng;

        $query = Unit::with('store')->latest('id');

        if (!is_null($lat) && !is_null($lng)) {
            $query = DistanceHelper::filterByDistance($query, $lat, $lng, 'store');
        }

        $units = $query->take(5)->get();

        return response()->json([
            'data' => $units,
            'message' => $units->isNotEmpty() ? 'Units found successfully.' : 'No units found.',
            'status' => $units->isNotEmpty() ? 200 : 404,
        ], $units->isNotEmpty() ? 200 : 404);
    }
}
