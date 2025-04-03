<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Point;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Throwable;

class OrderController extends Controller
{

    public function index($id)
    {
        $order = Order::whereCustomerId($id)->get();
        if ($order->count() > 0) {
            return response()->json([
                'message' => 'Orders found',
                'data' => $order
            ], 200);
        } else {
            return response()->json(['message' => 'No Order found'], 200);
        }
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'store_id' => 'required|exists:stores,id',
            'customer_id' => 'required|exists:customers,id',
            'delivary_value' => 'required|numeric',
            'discount_value' => 'required|numeric',
            'tax_value' => 'required|numeric',
            'sub_total' => 'required|numeric',
            'summation' => 'required|numeric',
            'status' => 'required|numeric|between:0,5',
            'receipt_type' => 'required|in:0,1',
            'time' => 'required|date',
            'units' => 'required|array|min:1',
            'units.*.item_id' => 'required|exists:items,id',
            'units.*.unit_id' => 'required|exists:units,id',
            'units.*.quantity' => 'required|integer|min:1',
            'units.*.total' => 'required|numeric|min:1',
        ]);

        $order = DB::transaction(function () use ($validated) {
            $storeId = $validated['store_id'];
            $itemIds = collect($validated['units'])->pluck('item_id')->unique();
            $unitIds = collect($validated['units'])->pluck('unit_id')->unique();

            // جلب جميع الـ items الخاصة بالـ store دفعة واحدة
            $storeItems = Item::whereIn('id', $itemIds)->where('store_id', $storeId)->pluck('id')->toArray();

            // جلب جميع الـ units المرتبطة بالـ store عبر الـ items دفعة واحدة
            $storeUnits = Unit::whereIn('id', $unitIds)
                ->whereHas('item', function ($query) use ($storeId) {
                    $query->where('store_id', $storeId);
                })
                ->pluck('id')
                ->toArray();

            foreach ($validated['units'] as $unit) {
                if (!in_array($unit['item_id'], $storeItems)) {
                    throw ValidationException::withMessages([
                        'units' => ["Item ID {$unit['item_id']} does not belong to the specified store."],
                    ]);
                }

                if (!in_array($unit['unit_id'], $storeUnits)) {
                    throw ValidationException::withMessages([
                        'units' => ["Unit ID {$unit['unit_id']} does not belong to the specified store."],
                    ]);
                }
            }

            $order = Order::create([
                'store_id' => $storeId,
                'customer_id' => $validated['customer_id'],
                'driver_id' => null,
                'delivary_value' => $validated['delivary_value'],
                'discount_value' => $validated['discount_value'],
                'tax_value' => $validated['tax_value'],
                'sub_total' => $validated['sub_total'],
                'summation' => $validated['summation'],
                'status' => $validated['status'],
                'receipt_type' => $validated['receipt_type'],
                // 'receipt_type' => 1,
                'time' => $validated['time'],
            ]);

            // إدراج جميع الوحدات دفعة واحدة
            $order->orderUnit()->createMany(
                collect($validated['units'])->map(function ($unit) use ($storeId, $validated) {
                    return [
                        'item_id' => $unit['item_id'],
                        'customer_id' => $validated['customer_id'],
                        'store_id' => $storeId,
                        'quantity' => $unit['quantity'],
                        'unit_id' => $unit['unit_id'],
                        'total' => $unit['total'],
                    ];
                })->toArray()
            );

            // تحميل بيانات الوحدات المرتبطة بالطلب وإرجاعه
            return $order->load('orderUnit');
        });

        return response()->json([
            'data' => $order,
            'message' => $order ? 'Order created successfully' : 'Failed to create order.',
            'status' => $order ? 201 : 500, // 500 لأن الطلب يجب أن يُنشأ دائماً، وإذا فشل فهو خطأ داخلي
        ], $order ? 201 : 500);
    }

    // public function show(Order $order)
    // {
    //     return response()->json([
    //         'message' => 'Order successfully',
    //         'data' => $order
    //     ], 200);
    // }

    // public function update(Request $request, Order $order)
    // {
    //     $data = $request->validate([
    //         'driver_id' => 'required|exists:drivers,id',
    //     ]);

    //     $order->update($data);
    //     return response()->json([
    //         'message' => 'Order updated successfully',
    //         'data' => $order
    //     ], 200);
    // }

    // public function destroy(Order $order)
    // {
    //     $order->delete();
    //     return response()->json([
    //         'message' => 'Order deleted successfully',
    //     ], 200);
    // }
}
