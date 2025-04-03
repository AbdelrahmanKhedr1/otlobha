<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|unique:tags',
            'name_en' => 'required|string|unique:tags',
            'category_id' => 'required|exists:categories,id',
        ]);

        Tag::create($data);

        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('dashboard.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $tag = Tag::findOrFail($id);
        $data = $request->validate([
            'name_ar' => 'required|string|unique:tags,id',
            'name_en' => 'required|string|unique:tags,id',
            'category_id' => 'required|exists:categories,id',
        ]);
        $tag->update($data);
        return redirect()->route('tag.index');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy($id)
    // {
    //     Tag::destroy($id);
    //     return back();
    // }
}
