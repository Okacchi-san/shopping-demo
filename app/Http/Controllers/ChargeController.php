<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        // Create a charge: this will charge the user's card
        try {
          $charge = Charge::create(array(
            "amount" => $total, // 課金額はココで調整
            "currency" => "jpy",
            "source" => $token,
            "description" => "Example charge"
            ));
        } catch(\Error\Card $e) { 
      // The card has been declined
        }
        
    // サンクスメール送る...
    //return redirect()->route('pdf.get');

    $request->session()->forget('cart');
    
    return redirect('/home')->with('success', 'お買い上げありがとうございます。');
    }
    
}
