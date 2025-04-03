<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StoreRate;
use Illuminate\Http\Request;

class StoreRateController extends Controller
{
    public function storeRate(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'store_id' => 'required|exists:stores,id',
            'message' => 'nullable|string|max:255',
            'rate' => 'required|integer|min:20|max:100',
        ]);

        $storeRate = StoreRate::updateOrCreate(
            [
                'customer_id' => $request->customer_id,
                'store_id' => $request->store_id,
            ],
            [
                'message' => $request->message,
                'rate' => $request->rate
            ]
        );

        return response()->json(['message' => 'تم حفظ التقييم بنجاح', 'data' => $storeRate]);
    }

    public function destroy($id)
    {
        $storeRate = StoreRate::findOrFail($id);
        $storeRate->delete();

        return response()->json(['message' => 'تم حذف التقييم بنجاح']);
    }
}
