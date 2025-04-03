<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $item = Item::whereId($id)->first();
        $units = Unit::where('item_id', $id)->paginate(10);
        return view('dashboard.unit.index', compact('item', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $item = Item::findOrFail($id);
        return view('dashboard.unit.create', compact('item'));
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
            'time' => 'required|integer|min:0',
            'is_percentage' => 'required|in:0,1',
            'image' => 'nullable|image',
            'item_id' => 'required|exists:items,id',
            'prodect_id' => 'required|exists:prodects,id',
            'category_id' => 'required|exists:categories,id',
        ]);
        if ($request->hasFile('image')) {
            $img = $request->file('image')->store('unit', 'public');
            $data['image'] = 'storage/' . $img;
        };
        Unit::create($data);

        return to_route('unit.index', $data['item_id']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $unit = Unit::findOrFail($id);
        $item = Item::whereId($unit->item_id)->first();
        return view('dashboard.unit.edit', compact('item', 'unit'));
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
            'time' => 'required|integer|min:0',
            'is_percentage' => 'required|in:0,1',
            'image' => 'nullable|image',
            'item_id' => 'required|exists:items,id',
            'prodect_id' => 'required|exists:prodects,id',
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
        $unit->create($data);

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
