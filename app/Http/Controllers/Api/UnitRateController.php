<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StoreRate;
use App\Models\UnitRate;
use Illuminate\Http\Request;

class UnitRateController extends Controller
{
    public function unitRate(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'unit_id' => 'required|exists:units,id',
            'message' => 'nullable|string|max:255',
            'rate' => 'required|integer|min:20|max:100',
        ]);

        $unitRate = UnitRate::updateOrCreate(
            [
                'customer_id' => $request->customer_id,
                'unit_id' => $request->unit_id,
            ],
            [
                'message' => $request->message,
                'rate' => $request->rate
            ]
        );

        return response()->json(['message' => 'تم حفظ التقييم بنجاح', 'data' => $unitRate]);
    }

    public function destroy($id)
    {
        $unitRate = UnitRate::findOrFail($id);
        $unitRate->delete();

        return response()->json(['message' => 'تم حذف التقييم بنجاح']);
    }
}
