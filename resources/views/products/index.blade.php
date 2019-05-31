@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    
    @if (count($products) > 0)
   
        @foreach ($products as $product)
            <div class="col-sm-4 col-md-offset-1 mx-auto">
                <div class="card">
                    <div class="card-header">
                        商品番号{{ $product->id }}    
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">商品名{{ $product->name }}</h5>
                        <p class="card-text">価格{{ $product->amount }}円</p>
                    </div>
                    <div class="card-footer text-right">
                     <form action="/product/session" method="post">
                        {{ csrf_field() }}    
                        
                        <input readonly type="hidden" name="productName" value="{{ $product->name }}">
                        
                        <button type="submit" class="btn btn-info">カートへ入れる</button>
                        
    
        
     
        </form>
                    </div>
                </div>      
            </div>    
    @endforeach

                      
    @endif
    </div>       
</div>
@endsection
