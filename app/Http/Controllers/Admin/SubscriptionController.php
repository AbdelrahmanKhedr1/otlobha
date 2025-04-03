<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\subscription;


use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.subscription.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $store = Store::all();
        return view('dashboard.subscription.create', compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after:start_at',
            'store_id' => 'required|exists:stores,id',
            'summation' => 'required|integer',

        ]);
        subscription::create($data);

        return redirect()->route("subscription.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $subscription = subscription::findOrFail($id);
        return view('dashboard.subscription.edit', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $update = subscription::findOrFail($id);
        $data =   $request->validate([
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after:start_at',
            'summation' => 'required|integer',
        ]);
        $update->update($data);
        return redirect()->route("subscription.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        subscription::destroy($id);
        return redirect()->route("subscription.index");
    }

    public function endSub()
    {
        $subscriptions = subscription::where('end_at', '<', now())->orderBy('id', 'desc')->get();
        // foreach ($subscription as $sub) {
        //     $sub->update(['end_at' => now()]);
        // }
        return view('dashboard.subscription.endSub', compact('subscriptions'));

        // return redirect()->route("subscription.endSub");
    }
}
