<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\ImageUnit;
use App\Models\Unit;
use Illuminate\Http\Request;

class ImageUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $unit = Unit::findOrFail($id);
        $image_unit = ImageUnit::where('unit_id', $id)->paginate(8);
        return view('store.image_unit.index', compact('unit', 'image_unit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $unit = Unit::findOrFail($id);
        return view('store.image_unit.create', compact('unit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'images.*' => 'required|image', // السماح بعدة صور
            'unit_id' => 'required|exists:units,id',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imgPath = $image->store('image_unit', 'public');
                ImageUnit::create([
                    'image' => 'storage/' . $imgPath,
                    'unit_id' => $request->unit_id,
                ]);
            }
        }

        return to_route('image-unit.index', $request->unit_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ImageUnit::destroy($id);
        return back();
    }
}
