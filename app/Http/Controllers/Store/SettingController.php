<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $store = Store::where('user_id', Auth::id())->first();

        return view('store.setting.index', compact('store'));
    }



    public function updateOrCreateStore(Request $request)
    {
        $store = Store::where('user_id', Auth::id())->first();

        $rules = [
            'name' => 'required|string|max:255',
            'mobile' => [
                'required',
                'string',
                'regex:/^01[0-9]{9}$/',
                Rule::unique('stores', 'mobile')->ignore($store->id ?? null),
            ],
            'address' => 'required|string|max:100',
            'image' => 'nullable|image',
            // 'category_id' => 'required|exists:categories,id',
            // 'lng' => 'required|numeric',
            // 'lat' => 'required|numeric',
            // 'start_time' => 'required|date_format:H:i',
            // 'end_time' => 'required|date_format:H:i|after:start_time',
        ];

        if (!$store) {

            $rules['category_id'] = 'required|exists:categories,id';
            $rules['lng'] = 'required|numeric';
            $rules['lat'] = 'required|numeric';
            $rules['start_time'] = 'required|date_format:H:i';
            $rules['end_time'] = 'required|date_format:H:i|after:start_time';
        } else {
            // في حالة التعديل، نتحقق إذا كان الوقت قد تم إرساله بدون ثوانٍ
            if ($request->has('start_time') && !str_contains($request->start_time, ':00')) {
                $rules['start_time'] = 'required|date_format:H:i';
            }

            if ($request->has('end_time') && !str_contains($request->end_time, ':00')) {
                $rules['end_time'] = 'required|date_format:H:i|after:start_time';
            }
        }
        $data = $request->validate($rules);

        // // فقط عند إنشاء متجر جديد نضيف الإحداثيات
        // if (!$store) {
        //     $data['lat'] = $request->lat;
        //     $data['lng'] = $request->lng;
        // }

        // التعامل مع الصورة إذا تم رفعها
        if ($request->hasFile('image')) {
            if ($store && !empty($store->image) && Storage::exists($store->image)) {
                Storage::delete($store->image);
            }
            $img = $request->file('image')->store('store', 'public');
            $data['image'] = 'storage/' . $img;
        }

        Store::updateOrCreate(['user_id' => Auth::id()], $data);

        return redirect()->route('setting.index')->with('success', 'تم تحديث إعدادات المتجر بنجاح.');
    }
}
