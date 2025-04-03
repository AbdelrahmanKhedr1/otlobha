<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DistanceHelper;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use App\Models\Unit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    // //   ال $id بتاع ال category


    public function store(Request $request, $id)
    {
        $request->validate([
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ]);

        $lat = $request->lat;
        $lng = $request->lng;

        $storesQuery = Store::where("category_id", $id)->select('stores.*'); // تأكد من جلب جميع الحقول

        // تطبيق الفلترة بناءً على الإحداثيات إذا تم تمريرها
        if (!is_null($lat) && !is_null($lng)) {
            $storesQuery = DistanceHelper::filterByDistance(
                $storesQuery,
                $lat,
                $lng,
                null, // لا توجد علاقة هنا
                50,
                'stores.lat',
                'stores.lng'
            );
        }

        $stores = $storesQuery->paginate(10);

        $stores->getCollection()->each->append('average_rating', 'rating_customers_count');

        return response()->json([
            'stores' => $stores,
            'message' => $stores->isNotEmpty() ? 'Stores found successfully.' : 'No stores found.',
            'status' => $stores->isNotEmpty() ? 200 : 404,
        ], $stores->isNotEmpty() ? 200 : 404);
    }

    // //   ال $id بتاع ال store

    public function product($id)
    {
        try {
            $store = Store::with([
                'offer',
                'item' => function ($query) {
                    $query->with([
                        'unit' => function ($query) {
                            $query->orderBy('id', 'desc')
                                ->with(['unitImages' => function ($query) {
                                    $query->orderBy('id', 'desc')->take(1);
                                }])
                                ->take(5);
                        }
                    ])->paginate(10);
                }
            ])->findOrFail($id);

            return response()->json([
                'data' => $store,
                'message' => 'Product and items found successfully',
                'status' => 200,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Store not found.',
                'status' => 404,
            ], 404);
        }
    }

    // //   ال $id بتاع ال item

    // public function item(string $id)
    // {
    //     try {
    //         // جلب العنصر الأساسي مع العلاقات الأخرى
    //         $item = Item::findOrFail($id);

    //         // تطبيق الـ paginate على الوحدة (unit)
    //         $units = $item->unit()
    //             ->orderBy('id', 'desc')
    //             ->with(['unitImages' => function ($query) {
    //                 $query->orderBy('id', 'desc');
    //             }])->paginate(10); // تحديد عدد العناصر لكل صفحة
    //         $units->getCollection()->each->append('average_rating', 'rating_customers_count');
    //         return response()->json([
    //             'message' => 'Item found successfully',
    //             'data' => [
    //                 'item' => $item,
    //                 'units' => $units, // إرجاع البيانات المصفحة للوحدات
    //             ],
    //         ], 200);
    //     } catch (ModelNotFoundException $e) {
    //         return response()->json([
    //             'message' => 'Item not found',
    //         ], 404);
    //     }
    // }


    public function unit(string $id)
    {
        $tags = Tag::whereHas('items', function ($query) use ($id) {
            $query->where('items.id', $id);
        })->get();
        $units = Unit::whereItemId($id)->orderBy('id', 'desc')
            ->with(['unitImages' => function ($query) {
                $query->orderBy('id', 'desc');
            }])->paginate(10); // تحديد عدد العناصر لكل صفحة
        $units->getCollection()->each->append('average_rating', 'rating_customers_count');

        if ($units->count() > 0) {
            return response()->json([
                'message' => 'Find units',
                'status' => 200,
                'data' => [
                    'tags' => $tags,
                    'units' => $units,
                ],

            ], 200);
        } else {
            return response()->json(['message' => 'No found units'], 404);
        }
    }
}
