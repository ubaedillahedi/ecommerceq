<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $categories = Category::where('title', 'LIKE', '%' . $request->get('q') . '%')->paginate(5);
        return view('categories.index', compact('categories', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255|unique:categories',
            'parent_id' => 'exists:categories,id'
        ]);
        Category::create($request->all());
        // \Flash::success('Kategori' . $request->get('title'), ' disimpan');
        return redirect()->route('categories.index')->with('success', 'Kategori ' . $request->get('title') . ' disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findorfail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrfail($id);
        $this->validate($request, [
            'title' => 'required|string|max:255|unique:categories,title,'.$category->id,
            'parent_id' => 'exists:categories,id'
        ]);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('updated', 'Kategori ' . $request->get('title') . ' diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        Category::find($id)->delete();
        return redirect()->route('categories.index')->with('deleted', 'Kategori ' . $category->title . ' dihapus');
    }
}
