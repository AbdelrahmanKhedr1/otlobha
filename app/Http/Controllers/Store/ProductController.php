<?php

namespace App\Http\Controllers\Store;

use App\Events\NewMessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Store;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Notification;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::all();
        // return view('store.product.index', compact('products'));



        $store = Auth::user()->store;
        // var_dump($store);
        if(!is_null($store)){
            return view('store.product.index',compact('store'));
        }else{
            return to_route('store.dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $store = Auth::user()->store;
        return view('store.product.create', compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'store_id' => 'required|exists:stores,id',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $img = $request->file('image')->store('product', 'public');
            $data['image'] = 'storage/' . $img;
        };
        Product::create($data);

        // $admin= Admin::first();
        // Notification::send($admin,new NewMessageNotification(Auth::user()));

        // event(new NewMessageEvent($ccc));
        // NewMessageEvent::dispatch($ccc);
        NewMessageEvent::dispatch($data);
        // Broadcast(new NewMessageEvent($data));

        // $admin->notify(new NewMessageNotification(Auth::user()));

        return to_route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('store.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $store = Store::whereId($product->store_id)->first();

        return view('store.product.edit', compact('store', 'product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'store_id' => 'required|exists:stores,id',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            if (!empty($product->image)) {
                unlink($product->image);
            }
            $img = $request->file('image')->store('product', 'public');
            $data['image'] = 'storage/' . $img;
        } else {
            unset($data['image']);
        };
        $product->update($data);
        return to_route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return back();
    }
}
