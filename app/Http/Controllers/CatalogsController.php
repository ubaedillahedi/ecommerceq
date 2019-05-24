<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;

class CatalogsController extends Controller
{
    public function index(Request $request)
    {
        $cat = null;
        $category = null;
        if($request->has('cat'))
        {
            $cat = $request->get('cat');
            $category = Category::findorfail($cat);
            /**
             * we use this to get product from current category and its child
             */
            $products = Product::wherein('id', $category->related_products_id)->paginate(4);
        }
        else
        {
            $products = Product::paginate(4);
        }
        return view('catalogs.index', compact('products', 'cat', 'category'));
    }
}
