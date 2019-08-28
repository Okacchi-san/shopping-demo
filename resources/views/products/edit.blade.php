@extends('layouts.app_admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 mx-auto">
            
            <div class="card">
                <div class="card-header">商品情報更新</div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('product.update') }}" enctype="multipart/form-data">
                    {{ method_field('put') }}    
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">商品名:</label>
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                    </div>
                    <div class="form-group">
                        <label for="amount">価格:</label>
                        <input type="text" class="form-control" name="amount" value="{{ $product->amount }}">
                    </div>
                    <div class="form-group">
                        <label for="description">商品説明:</label>
                        <textarea name="description" class="form-control" rows="5">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">画像:</label>
                        <input type="file" id="file" name="file" class="form-control" value="{{ asset('storage/productImages/' . $product->image) }}">
                        <p class="img-responsive text-center mt-3"><img src="{{ asset('storage/productImages/' . $product->image) }}"></p>
                    </div>
                    <div class="form-group text-center">
                        <input readonly type="hidden" name="productId" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-info">更新</button>
                    </div>    
                    </form>
                </div>
            </div>
        </div>  
    </div>
</div>

@endsection