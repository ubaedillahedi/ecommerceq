<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;

class ProductsController extends Controller
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
        $products = Product::where('name', 'LIKE', '%'.$q.'%')
                ->orWhere('model', 'LIKE', '%'.$q.'%')
                ->orderBy('name')->paginate(5);
        return view('products.index', compact('products', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'name' => 'required|unique:products',
            'model' => 'required',
            'photo' => 'mimes:jpeg,png|max:10240',
            'price' => 'required|numeric|min:1000'
        ]);

        $data = $request->only('name', 'model', 'price');
        if($request->hasFile('photo'))
        {
            $data['photo'] = $this->savePhoto($request->file('photo'));
        }
        $product = Product::create($data);
        $product->categories()->sync($request->get('category_lists'));
        return redirect()->route('products.index')->with('success', 'Produk ' . $request->get('name') . ' disimpan');
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
        $product = Product::findorfail($id);
        return view('products.edit', compact('product'));
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
        $product = Product::findorfail($id);
        $this->validate($request, [
            'name' => 'required|unique:products,name,'. $product->id,
            'model' => 'required',
            'photo' => 'mimes:jpeg,png|max:10240',
            'price' => 'required|numeric|min:1000'
        ]);
        $data = $request->only('name', 'model', 'price');
        if($request->hasFile('photo'))
        {
            $data['photo'] = $this->savePhoto($request->file('photo'));
            if($product->photo !== '') $this->deletePhoto($product->photo);
        }

        $product->update($data);
        if(count($request->get('category_lists')) > 0)
        {
            $product->categories()->sync($request->get('category_lists'));
        }
        else
        {
            /**
             * no category set, detach all
             */
            $product->categories()->detach();
        }

        return redirect()->route('products.index')->with('updated', 'Produk ' . $request->get('name') . ' diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product->photo !== '') $this->deletePhoto($product->photo);
        $product->delete();
        return redirect()->route('products.index')->with('deleted', 'Produk ' . $product->name . ' dihapus');
    }

    protected function savePhoto(UploadedFile $photo)
    {
        $filename = str_random(40) . '.' . $photo->guessClientExtension();
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        $photo->move($destinationPath, $filename);
        return $filename;
    }

    protected function deletePhoto($filename)
    {
        $path = public_path() . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $filename;
        return File::delete($path);
    }
}
