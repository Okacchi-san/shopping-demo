<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\OrderProduct;
use Auth;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class ChargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    /*単発決済用のコード*/
    public function charge(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_APP_KEY'));
        
        // Get the credit card details submitted by the form
        $token = $_POST['stripeToken'];
        $total = $request->total;
        $oldCart = collect($request->session()->get('cart'));
        
        // Create a charge: this will charge the user's card
        try {
            $charge = Charge::create(array(
                "amount" => $total, // 課金額はココで調整
                "currency" => "jpy",
                "source" => $token,
                "description" => "Example charge"
            ));
            
            $order = Order::create([
                'user_id' => Auth::id(),
                ]);
    
            foreach($oldCart as $val)
            {
                $qty = $val[0]['qty'];
                $productId = $val[0]['id'];
                OrderProduct::create([
                    'order_id'    => $order->id,
                    'qty' => $qty,
                    'product_id' => $productId,
                ]);
            }
            
        } catch(\Error\Card $e) { 
      // The card has been declined
        }
        
    // サンクスメール送る...

    $request->session()->forget('cart');
    
    return redirect()->route('download.get')->with('success', 'お買い上げありがとうございます。');
    }
    
}
