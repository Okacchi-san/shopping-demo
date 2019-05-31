<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $products = Product::all();
        
        return view('products.index', ['products' => $products]);
    }
    
    
    public function indexSession(Request $request)
    {
        
        $productname = $request->session()->get('msg')['productName'];
        
        return view('products.session',['product_name' => $productname]);
}

    public function ses_put(Request $request)
    {
        $msg = $request->input();
        
        $request->session()->put('msg',$msg);
        return redirect('product');
    }

}
