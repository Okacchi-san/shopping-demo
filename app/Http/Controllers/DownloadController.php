<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\OrderProduct;
use Auth;

class DownloadController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    
    }

    public function index()
    {   
        
        $orders = Order::where('user_id',Auth::id())->get();

        return view('document.download', ['orders' => $orders]);
    } 
}