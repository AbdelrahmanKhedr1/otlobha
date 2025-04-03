<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DistanceHelper;
use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function storeOffers($id)
    {
        $offers = Offer::whereStoreId($id)
            // ->active()
            ->with('imageOffer')
            ->paginate(10);

        if ($offers->isNotEmpty()) {
            return response()->json([
                'data' => $offers,
                'message' => 'Offers found successfully.',
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'message' => 'No offers found.',
            'status' => 404,
        ], 404);
    }


    public function allOffers(Request $request)
    {
        $request->validate([
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ]);

        $lat = $request->lat;
        $lng = $request->lng;

        $offersQuery = Offer::with('imageOffer','store');

        if (!is_null($lat) && !is_null($lng)) {
            $offersQuery = DistanceHelper::filterByDistance($offersQuery, $lat, $lng, 'store');
        }

        $offers = $offersQuery->paginate(10);

        return response()->json([
            'data' => $offers,
            'message' => $offers->isNotEmpty() ? 'Offers found successfully.' : 'No offers found.',
            'status' => $offers->isNotEmpty() ? 200 : 404,
        ], $offers->isNotEmpty() ? 200 : 404);
    }
}
