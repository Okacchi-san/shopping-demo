<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    
    public function __construct(Product $product)
    {
        $this->middleware('auth');
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
            $request->session()->push('cart.'.$cart['id'], $cart);
        
            return redirect()->route('product.get');
        
        }else{
             foreach($oldCart as $val)
            {
                if($val[0]['id'] === $cart['id'])
                {
                    $cart['qty'] += $val[0]['qty'];
                   
                    $request->session()->forget('cart.'.$cart['id']);
                    $request->session()->push('cart.'.$cart['id'], $cart);
                    
                }else{
                    $request->session()->push('cart.'.$cart['id'], $cart);
   
                }
            } 
            return redirect()->route('product.get');
        }
    }
    
    public function update(Request $request)
    {
        $productIdInc = $request->productIdInc;
        $productIdDec = $request->productIdDec;
        $carts = $request->session()->get('cart');
        
        foreach($carts as $cart){
            if($cart[0]['id'] == $productIdInc){
                $cart[0]['qty']++;
                
                $request->session()->put('cart.'.$productIdInc, $cart);
            }
            if($cart[0]['id'] == $productIdDec){
                if($cart[0]['qty'] == 1){
                   $request->session()->forget('cart.'.$productIdDec); 
                }else{
                    $cart[0]['qty']--;

                    $request->session()->put('cart.'.$productIdDec, $cart);    
                }
            }
        }
        return back();
    }
    
    public function destroy(Request $request)
    {
        $productId = $request->productId;
        
        $request->session()->forget('cart.'.$productId);
        
        return back();
    }
}
