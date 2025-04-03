<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Store;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $store = Store::findOrFail($id);
        return view('dashboard.offer.index', compact('id','store'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $store = Store::findOrFail($id);
        return view('dashboard.offer.create', compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'store_id' => 'required|exists:stores,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        Offer::create($data);
        return to_route('offer.index', $data['store_id']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $store = Store::whereId($offer->store_id)->first();

        return view('dashboard.offer.edit', compact('store', 'offer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Offer = Offer::findOrFail($id);
        $data = $request->validate([
            'store_id' => 'required|exists:stores,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $Offer->update($data);
        return to_route('offer.index', $data['store_id']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Offer::destroy($id);
        return back();
    }
}
