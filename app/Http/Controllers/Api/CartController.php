<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $cart = Cart::all();
        if ($cart->count() > 0) {
            return response()->json([
                'data' => $cart,
                'message' => 'cart successfully',
            ],200);
        } else {
            return response()->json([
                'message' => 'cart does not exist.',
            ],404);
        }
    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'item_id' => 'required|exists:items,id',
            'unit_id' => 'required|exists:units,id',
            'total' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::create($data);

        return response()->json([
            'message' => 'cart created successfully',
            'data' => $cart
        ], 201);
    }

    public function show(Cart $cart)
    {
        return response()->json([
            'message' => 'cart  successfully',
            'data' => $cart
        ], 200);
    }

    public function update(Request $request, Cart $cart)
    {
        $data = $request->validate([
            'item_id' => 'required|exists:items,id',
            'unit_id' => 'required|exists:units,id',
            'total' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:18|max:65',
        ]);

        $cart->update($data);

        return response()->json([
            'message' => 'cart updated successfully',
            'data' => $cart
        ], 200);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return response()->json([
            'message' => 'cart deleted successfully',
        ], 200);
    }
}
