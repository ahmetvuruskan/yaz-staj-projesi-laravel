<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pages;
use App\Models\Product;
use App\Models\Sliders;
use Illuminate\Http\Request;
use Intervention\Image\Image;

class IndexController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::orderBy('category_must')->get();
        $data['sliders'] = Sliders::all();
        /* Anasayfa bloklarına ver çekerken tablolara join işlemi uyguluyoruz. */

        // Anasayfa bilgisayar kategorisi blok verisi.
        $data['computer'] = Product::where('product_category', 2)
            ->where('photos.showcase', '1')
            ->join('photos', 'products.product_id', '=', 'photos.product_id')
            ->orderBy('products.id', 'desc')
            ->take(4)
            ->get();
        $data['category_slug'] = Category::orderBy('id', 'asc')->pluck('category_slug');
        // Anasayfa telefon tablet kategorisi blok verisi.
        $data['phone'] = Product::where('product_category', 3)
            ->where('photos.showcase', '1')
            ->join('photos', 'products.product_id', '=', 'photos.product_id')
            ->orderBy('products.id', 'desc')
            ->take(4)
            ->get();
        $data['homep'] = Product::where('product_category', 5)
            ->where('photos.showcase', '1')
            ->join('photos', 'products.product_id', '=', 'photos.product_id')
            ->orderBy('products.id', 'desc')
            ->take(4)
            ->get();
        $data['pages'] = Pages::all();

        return view('Frontend.index')->with('data', $data);
    }

    public function search(Request $request)
    {
        $data['products'] = Product::where('product_name','LIKE',"%$request->s%")
            ->join('photos','products.product_id','=','photos.product_id')
            ->paginate(20);
        $data['category'] =Category::all();

//dd($data);
        return view('Frontend.search')->with('data',$data);
    }
}
