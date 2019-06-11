<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    
    public function index()
    {
        $products = Product::all();
        
        return view('products.index', ['products' => $products]);
    }
    
    
    public function store(Request $request)
    {
        $productId = $request->session()->get('productId');
        $product = Product::find($productId);
        
        $qty = $request->session()->get('qty');
        dd($qty);
        $count_products = collect($productId)->count();
        dd($count_products);
        return view('products.session',[
            'product' => $product,
            'qty' => $qty,
            'count_products' => $count_products,
        ]);
    }
    
    


    public function ses_put(Request $request)
    {
        $product_info = $request->input('productInfo');
        $productInfo = explode(",",$product_info);
        $qty = $request->post('qty');
        
        $request->session()->push('productId',$productInfo[0]);
        $request->session()->push('qty',$qty);
        
        
        
        return redirect()->route('product.get');
    }


}
