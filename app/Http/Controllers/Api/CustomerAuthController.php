<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string|regex:/^01[0-9]{9}$/|unique:customers',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
            'lng' => 'required|numeric',
            'lat' => 'required|numeric',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'lng' => $request->lng,
            'lat' => $request->lat,
            'password' => Hash::make($request->password),
        ]);
        $token = $customer->createToken('customer-token', ['*'], now()->addDays(7))->plainTextToken;
        return response()->json([
            'token' => $token,
            'customer' => $customer,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^01[0-9]{9}$/',
            'password' => 'required|string',
        ]);

        $customer = Customer::where('phone', $request->phone)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            $token = $customer->createToken('customer-token', ['*'], now()->addDays(7))->plainTextToken;
            $order = Order::whereCustomerId($customer->id)->get();
            $order_unit = OrderUnit::whereCustomerId($customer->id)->get();
            return response()->json([
                'token' => $token,
                'customer' => $customer,
                'order' => $order,
                'order_unit' => $order_unit,
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
