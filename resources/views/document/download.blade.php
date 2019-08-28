@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 mx-auto">
            <div class="card">
                <div class="card-header">お買い上げ商品履歴</div>
                <div class="card-body">
                    <div class="card-subtitle mb-3 text-info">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if (count($orders) > 0)
            @foreach($orders as $order)
            <div class="card mt-3">
            <div class="card-header text-center"><small class="text-muted">お買い上げ商品</small></div> 
                @php
                    $total = 0;
                    $tax = 0;
                    $product = null;
                    $qty = null;
                @endphp
                @php
                    $order_products = App\OrderProduct::where('order_id',$order->id)->get();
                @endphp
                @foreach($order_products as $order_product)
                @php
                    $qty = $order_product->qty;
                    $product = App\Product::find($order_product->product_id);
                    $subTotal = $qty*$product->amount;
                    $total += $subTotal;
                @endphp
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><small class="text-muted">商品名：{{ $product->name }}</small>&emsp;<span class=session__items_count>単価：{{ $product->amount }}円</span>&emsp;<span class=session__items_count>アイテム数：{{ $qty }}個</span>
                            &emsp;<small class="text-muted">小　計：{{ $subTotal }}円</small>&emsp;</li>
                        </ul>
                    </div>
                @endforeach
            @php
                $tax = $total*0.08;
            @endphp    
                <div class="card-footer text-muted">
                    &emsp;<small class="text-muted">合　計：{{ $total+$tax }}円</small>&emsp;<small class="text-muted">（内消費税：{{ $tax }}円）</small>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection