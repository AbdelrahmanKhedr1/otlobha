<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\ImageUnit;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {

        // dd($id);
        $item = Item::findOrFail($id);
        // dd($id,$item);
        return view('store.unit.index', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $item = Item::findOrFail($id);
        return view('store.unit.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|integer|min:0',
            'discount' => 'nullable|integer|min:0',
            'from_time' => 'nullable|integer|min:0',
            'to_time' => 'nullable|integer|min:0|gte:from_time',
            'pro_date' => 'nullable|date|',
            'exp_date' => 'nullable|date|after:pro_date',
            'taxValue' => 'nullable|integer|min:0',
            'stock_quantity' => 'nullable|integer|min:0',
            'is_percentage' => 'required|in:0,1,2',
            'item_id' => 'required|exists:items,id',
            'store_id' => 'required|exists:stores,id',
            'product_id' => 'required|exists:products,id',
            'category_id' => 'required|exists:categories,id',
        ]);
        Unit::create($data);

        return to_route('unit.index', $data['item_id']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unit = Unit::findOrFail($id);
        $unit_images = ImageUnit::where('unit_id', $id)->paginate(4);
        return view('store.unit.show', compact('unit','unit_images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $unit = Unit::findOrFail($id);
        $item = Item::whereId($unit->item_id)->first();
        return view('store.unit.edit', compact('item', 'unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $unit = Unit::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|integer|min:0',
            'discount' => 'nullable|integer|min:0',
            'from_time' => 'nullable|integer|min:0',
            'to_time' => 'nullable|integer|min:0',
            'pro_date' => 'nullable|date|',
            'exp_date' => 'nullable|date|after:pro_date',
            'taxValue' => 'nullable|integer|min:0',
            'stock_quantity' => 'nullable|integer|min:0',
            'is_percentage' => 'required|in:0,1,2',
            'item_id' => 'required|exists:items,id',
            'store_id' => 'required|exists:stores,id',
            'product_id' => 'required|exists:products,id',
            'category_id' => 'required|exists:categories,id',
        ]);
        if ($request->hasFile('image')) {
            if (!empty($unit->image)) {
                unlink($unit->image);
            }
            $img = $request->file('image')->store('unit', 'public');
            $data['image'] = 'storage/' . $img;
        } else {
            unset($data['image']);
        };
        $unit->update($data);

        return to_route('unit.index', $data['item_id']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Unit::destroy($id);
        return back();
    }
}
