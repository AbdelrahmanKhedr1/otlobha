<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ImageUnit;
use App\Models\Item;
use App\Models\Store;
use App\Models\Unit;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.store.index', compact('id', 'category'));
    }

    public function show(string $id)
    {
        $store = Store::findOrFail($id);
        return view('dashboard.store.show', compact('store'));
    }

    public function product($id)
    {
        $store = Store::findOrFail($id);
        return view('dashboard.storeProduct.index', compact('id', 'store'));
    }

    // public function item($id)
    // {
    //     $prodect = Prodect::findOrFail($id);
    //     return view('dashboard.item.index', compact('id', 'prodect'));
    // }


    public function unit($id)
    {
        $item = Item::whereId($id)->first();
        return view('dashboard.unit.index', compact('item'));
    }
    public function unitShow($id)
    {
        $unit = Unit::findOrFail($id);
        $unit_images = ImageUnit::where('unit_id', $id)->paginate(4);
        return view('dashboard.unit.show', compact('unit', 'unit_images'));
    }

    public function unit_images($id)
    {
        $unit = Unit::findOrFail($id);
        $unit_images = ImageUnit::where('unit_id', $id)->paginate(8);
        return view('dashboard.unit_image.index', compact('unit', 'unit_images'));
    }

    public function order($id)
    {
        $store = Store::findOrFail($id);
        return view('dashboard.order.index', compact('store'));
    }

    public function toggleActive($id)
    {
        $store = Store::findOrFail($id);
        $store->active = $store->active == '1' ? '0' : '1';
        $store->save();

        return back();
    }
}
