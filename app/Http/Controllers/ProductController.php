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
        if ($request->session()->has('name')) {
            
        $sesdata = $request->session()->get('name')['input'];
        
        return view('products.session',['session_data' => $sesdata]);
    }
}

    public function ses_put(Request $request)
    {
        $name = $request->input();
        
        $request->session()->put('name',$name);
        return redirect('product');
    }

}
