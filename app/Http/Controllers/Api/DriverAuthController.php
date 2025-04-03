<?php

namespace App\Http\Controllers\Api;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class DriverAuthController
{

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers',
            'phone' => 'required|string|regex:/^01[0-9]{9}$/|unique:drivers',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'id_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $img = $request->file('image')->store('drivers/images', 'public');
            $data['image'] = 'storage/' . $img;
        };

        if ($request->hasFile('id_image')) {
            $img = $request->file('id_image')->store('drivers/id_images', 'public');
            $data['id_image'] = 'storage/' . $img;
        };
        $data['password'] = Hash::make($request->password);


        $driver = Driver::create($data);

        return response()->json([
            'token' => $driver->createToken('driver-token')->plainTextToken,
            'driver' => $driver,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $driver = Driver::where('email', $request->email)->first();

        if ($driver && Hash::check($request->password, $driver->password)) {
            return response()->json([
                'token' => $driver->createToken('driver-token')->plainTextToken,
                'driver' => $driver,
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);

    }
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('drivers')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? response()->json(['message' => 'Reset link sent to your email.'])
                    : response()->json(['message' => 'Unable to send reset link.'], 500);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $status = Password::broker('drivers')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($driver, $password) {
                $driver->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? response()->json(['message' => 'Password has been reset.'])
                    : response()->json(['message' => 'Failed to reset password.'], 500);
    }

}
