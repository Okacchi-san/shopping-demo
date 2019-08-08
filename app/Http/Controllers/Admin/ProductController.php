<?php

namespace App\Http\Controllers\Admin;;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        
        return view('products.index_admin', ['products' => $products]);
    }
    
    public function create()
    {
        $products = new Product;
        
        return view('products.create',[
            'products' => $products,
            ]);
    }
    
    public function adminStore(Request $request)
    {
        $this->validate($request, [
            'file' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ]
        ]);
        
        if ($request->file('file')->isValid([])) {
            $filename = $request->file->store('public/productImages');

            $product = Product::create([
                    'name'          =>$request['name'],
                    'amount'        =>$request['amount'],
                    'image'         =>basename($filename),
                    'description'   =>$request['description']
            ]);
            
            return redirect()->route('admin_home')->with('success', '保存しました。');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['file' => '画像がアップロードされていないか不正なデータです。']);
        }
    }
    
    public function store(Request $request)
    {
        $cart = collect($request->session()->get('cart'));

        return view('products.session_admin');
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
        
            return redirect()->route('admin_product.get');
        
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
            return redirect()->route('admin_product.get');
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
    
    public function adminEdit(Request $request)
    {
        $productId = $request->productId;
        $product = Product::find($productId);
        return view('products.edit',[
            'product' => $product,
            ]);
    }
    
    public function adminUpdate(Request $request)
    {
        $this->validate($request, [
            'file' => [
                // 必須
                //'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ]
        ]);
        
        $productId = $request->productId;
        $product = Product::find($productId);
        $product->name = $request->name;
        $product->amount = $request->amount;
        $product->description = $request->description;
        
        if($request->hasFile('file')){
            if ($request->file('file')->isValid([])) {
                \File::delete('storage/productImages/' . $product->image);
                $filename = $request->file->store('public/productImages');
                $product->image = basename($filename);
                
            }else {
                return redirect()
                ->back()
                ->withInput()
                ->withErrors(['file' => '画像がアップロードされていないか不正なデータです。']);
            }
        }
                
        $product->save();
        
        return redirect()->route('admin_product.get')->with('success', '更新しました。');
    }
    
    public function destroy(Request $request)
    {
        $productId = $request->productId;
        
        $request->session()->forget('cart.'.$productId);
        
        return back();
    }
    
    public function adminDestroy(Request $request)
    {
        $productId = $request->productId;
        $product = Product::find($productId);
        
        \File::delete('storage/productImages/' . $product->image);
        $product->delete();
        
        return back();
    }
}
