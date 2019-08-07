@extends('layouts.app_admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 mx-auto">
            
            <div class="card">
                <div class="card-header">商品登録</div>
                <div class="card-body">
                    
                    <form class="form-horizontal" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">商品名:</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="amount">価格:</label>
                        <input type="text" class="form-control" name="amount" placeholder="半角数字で入力してください。">
                    </div>
                    <div class="form-group">
                        <label for="description">商品説明:</label>
                        <textarea name="description" class="form-control" rows="5" placeholder="商品説明文は200文字以内です。"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">画像:</label>
                        <input type="file" id="file" name="file" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-info">登録</button>
                    </div>    
                    </form>
                </div>
            </div>
        </div>  
    </div>
</div>
                
@endsection