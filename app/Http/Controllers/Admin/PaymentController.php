<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Store;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $store = Store::findOrFail($id);
        return view('dashboard.payment.index',compact('store'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $store = Store::findOrFail($id);
        return view('dashboard.payment.create',compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|integer',
            'note' => 'nullable|string',
            'store_id' => 'required|exists:stores,id',
        ]);

        $data['date'] = now();
        $lastProcessNumber = Payment::where('store_id', $data['store_id'])->max('num_process');
        $data['num_process'] = $lastProcessNumber ? $lastProcessNumber + 1 : 1;

        Payment::create($data);

        return to_route('payment.index', $data['store_id']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $store = Store::whereId($payment->store_id)->first();
        return view('dashboard.payment.edit', compact('store', 'payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $data = $request->validate([
            'amount' => 'required|integer',
            'note' => 'nullable|string',
        ]);

        $payment->update($data);
        return to_route('payment.index', $payment->store->id);
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy($id)
    // {
    //     Payment::destroy($id);
    //     return back();

    // }
}
