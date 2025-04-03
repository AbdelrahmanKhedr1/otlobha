<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DashboardOffer;
use Illuminate\Http\Request;

class DashboardOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $dashOffers = DashboardOffer::all();
        return view('dashboard.dash-offers.index', compact('dashOffers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.dash-offers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'image' => 'required|image||max:22048',
            'description' => 'nullable|string',
            // 'type_id' => 'required|integer',
            // 'store_id' => 'nullable|exists:stores,id',
            // 'item_id' => 'nullable|exists:items,id',
        ]);

        if ($request->hasFile('image')) {
            $img = $request->file('image')->store('DashboardOffer', 'public');
            $data['image'] = 'storage/' . $img;
        };

        DashboardOffer::create($data);

        return redirect()->route('dashoffer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DashboardOffer $dashboardOffer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dashboardOffer = DashboardOffer::findOrFail($id);
        return view('dashboard.dash-offers.edit', compact('dashboardOffer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $DashboardOffer = DashboardOffer::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:22048',
            'description' => 'nullable|string',
            // 'type_id' => 'required|integer',
            // 'store_id' => 'nullable|exists:stores,id',
            // 'item_id' => 'nullable|exists:items,id',
        ]);

        if ($request->hasFile('image')) {
            if (!empty($DashboardOffer->image)) {
                unlink($DashboardOffer->image);
            }
            $img = $request->file('image')->store('DashboardOffer', 'public');
            $data['image'] = 'storage/' . $img;
        } else {
            unset($data['image']);
        };

        $DashboardOffer->update($data);
        return redirect()->route('dashoffer.index');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy($id)
    // {
    //     DashboardOffer::destroy($id);
    //     return back();
    // }
}
