<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Point;


class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $point = Point::all();
        if ($point->count() > 0) {
            return response()->json([
                'message' => 'point successfully',
                'data' => $point,
            ], 200);
        } else {
            return response()->json([
                'message' => 'point does not exist.',
            ], 404);
        }
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'customer_id' => 'required|exists:customers,id',
            'point' => 'required|integer',
        ]);

        $point = Point::create($data);

        return response()->json([
            'message' => 'point created successfully',
            'data' => $point
        ], 201);
    }

    public function show(Point $point)
    {
        return response()->json([
            'message' => 'point  successfully',
            'data' => $point
        ], 200);
    }

    public function update(Request $request, Point $point)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'customer_id' => 'required|exists:customers,id',
            'point' => 'required|integer',
        ]);

        $point->update($data);

        return response()->json([
            'message' => 'point updated successfully',
            'data' => $point
        ], 200);
    }

    public function destroy(Point $point)
    {
        $point->delete();

        return response()->json([
            'message' => 'point deleted successfully',
        ], 200);
    }
}
