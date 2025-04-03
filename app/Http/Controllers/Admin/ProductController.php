<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companys = Company::all();
        return view('dashboard.product.create', compact('companys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
            'company_id' => 'nullable|exists:companies,id',

        ]);

        if ($request->hasFile('image')) {
            $img = $request->file('image')->store('all_product', 'public');
            $data['image'] = 'storage/' . $img;
        };
        $data['company_id'] = $request->category_id == 2 ? $request->company_id : null;
        product::create($data);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $companys = Company::all();
        $product = product::findOrFail($id);
        return view('dashboard.product.edit', compact('product', 'companys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
            'company_id' => 'nullable|exists:companies,id',
        ]);

        if ($request->hasFile('image')) {
            $img = $request->file('image')->store('all_product', 'public');
            $data['image'] = 'storage/' . $img;
        }

        $data['company_id'] = $request->category_id == 2 ? $request->company_id : null;
        $product->update($data);

        return redirect()->route('product.index');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy($id)
    // {
    //     product::destroy($id);
    //     return back();
    // }
}
