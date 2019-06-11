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
                        <div class="container">
                        <div class="row">
                            <div class="col-4 form-group form-control-sm form-inline">
                                <label for="qty" class="mr-1">個数</label>
                                    <select id="qty" class="form-control w-50" name="qty">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                            </div>
                            <div class="col-7">
                                <input readonly type="hidden" name="productInfo" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-info mt-1">カートへ入れる</button>
                            </div>
                            
                        </div>
                        </div>
                    </form>
                    </div>
                </div>      
            </div>    
        @endforeach
    @endif
    </div>       
</div>
@endsection
