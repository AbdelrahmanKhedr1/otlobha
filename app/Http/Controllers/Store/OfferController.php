<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\ImageOffer;
use App\Models\Offer;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function index()
    {
        $store = Auth::user()->store;
        if (!is_null($store)) {
            return view('store.offer.index', compact('store'));
        } else {
            return to_route('store.dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $store = Auth::user()->store;
        return view('store.offer.create', compact('store'));
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
        return to_route('offer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $offer = Offer::findOrFail($id);
        $image_offer = ImageOffer::whereOfferId( $offer->id)->get();
        return view('store.offer.show', compact('offer','image_offer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $store = Store::whereId($offer->store_id)->first();

        return view('store.offer.edit', compact('store', 'offer'));
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
        return to_route('offer.index');
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
