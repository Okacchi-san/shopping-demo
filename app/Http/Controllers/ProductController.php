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
        $cart = collect($request->session()->get('cart'));
        
        return view('products.session');
    }
    

    public function ses_push(Request $request)
    {
        $productId = $request->productId;
        $product = Product::find($productId);
        $cart = [
            'id' => $product->id,
            'name' => $product->name,
            'amount' => $product->amount,
            'qty' => $request->qty,
        ];
        $oldCart = collect($request->session()->get('cart')); 
        
        
        if($oldCart->isEmpty())
        {
            $request->session()->push('cart.'.$cart['id'],$cart);
        
            return redirect()->route('product.get');
        
        }else{
             foreach($oldCart as $val)
            {
                if($val[0]['id'] === $cart['id'])
                {
                    $cart['qty'] += $val[0]['qty'];
                   
                    $request->session()->forget('cart.'.$cart['id']);
                    $request->session()->push('cart.'.$cart['id'],$cart);
                    
                }else{
                    $request->session()->push('cart.'.$cart['id'],$cart);
   
                }
            } 
            return redirect()->route('product.get');
        }
    }
    

    
}
