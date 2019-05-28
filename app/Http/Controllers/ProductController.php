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
    
    
    public function indexSession()
    {
        return view('products.session');
    }
    
    
    public function ses_get(Request $request)
    {
        $sesdata = $request->session()->get('name')['input'];
        
        return view('products.session',['session_data' => $sesdata]);
    }

    public function ses_put(Request $request)
    {
        $msg = $request->input();
        
        $request->session()->put('name',$msg);
        return redirect('product/session');
    }

}
