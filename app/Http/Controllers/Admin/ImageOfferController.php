<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageOffer;
use App\Models\Offer;
use Illuminate\Http\Request;

class ImageOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)

    {

        $offer = Offer::findOrFail($id);
        $image_offer = ImageOffer::where('offer_id', $id)->get();
        return view('dashboard.image_offer.index', compact('image_offer', 'offer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $offer = Offer::findOrFail($id);
        return view('dashboard.image_offer.create', compact('offer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'image' => 'required|image',
            'offer_id' => 'required|exists:offers,id',
        ]);
        if ($request->hasFile('image')) {
            $img = $request->file('image')->store('image_offer', 'public');
            $data['image'] = 'storage/' . $img;
        };

        ImageOffer::create($data);
        return redirect()->route('image-offer.index', $data['offer_id']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ImageOffer $imageOffer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImageOffer $imageOffer, $id)
    {
        $ImageOffer = ImageOffer::findOrFail($id);
        $Offer = Offer::whereId($ImageOffer->offer_id)->first();
        return view('dashboard.image_offer.edit', compact('ImageOffer', 'Offer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ImageOffer = ImageOffer::findOrFail($id);
        $data = $request->validate([
            'image' => 'required|image',
            'offer_id' => 'required|exists:offers,id',
        ]);
        if ($request->hasFile('image')) {
            $img = $request->file('image')->store('image_offer', 'public');
            $data['image'] = 'storage/' . $img;
        };


        $ImageOffer->update($data);
        return redirect()->route('image-offer.index', $data['offer_id']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ImageOffer::destroy($id);
        return back();
    }
}
