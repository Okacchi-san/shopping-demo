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
        
        $sesdata = $request->session()->get('msg')['input'];
        
        return view('products.session',['session_data' => $sesdata]);
}

    public function ses_put(Request $request)
    {
        $msg = $request->input();
        
        $request->session()->put('msg',$msg);
        return redirect('product');
    }

}
