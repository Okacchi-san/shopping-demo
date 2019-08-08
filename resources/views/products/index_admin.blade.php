@extends('layouts.app_admin')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
    @if (count($products) > 0)
        @foreach ($products as $product)
            <div class="col-sm-4 col-md-offset-1 mx-auto mb-3">
                <div class="card">
                    <div class="card-header index__card__title__id">
                        商品番号：{{ $product->id }}    
                    </div>
                    <div class="card-body">
                        <p class="img-responsive text-center"><img src="{{ asset('storage/productImages/' . $product->image) }}" alt="images"/></p>
                        <h5 class="card-title index__card__title">商品名　：　<span class="index__card__product">{{ $product->name }}</span></h5>
                        <p class="card-text index__card__title">価　格　：　<span class="index__card__product">{{ $product->amount }}円</span></p>
                        <p class="card-text index__card__description">{{ $product->description }}</p>
                    </div>
                    
                    <div class="card-footer text-right">
                    <form action='{{ route('product.edit') }}' method="GET">
                        {{ csrf_field() }}
                            <input readonly type="hidden" name="productId" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-success btn-sm session__btn__adminupdate">更新</button>
                    </form>
                    </div>
                    
                    <div class="card-footer text-right">
                    <form action='{{ route('admin_product.delete') }}' method="POST">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                            <input readonly type="hidden" name="productId" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-danger btn-sm session__btn">削除</button>
                    </form>
                    </div>
                    
                    <div class="card-footer text-right">
                    <form action="/admin/product/session" method="post" class="index__card__form">
                        {{ csrf_field() }}
                        <div class="container index__card__container">
                        <div class="row index__card__row">
                            <div class="col-5 index__card__col form-group form-control-sm form-inline">
                                <label for="qty" class="index__card__qty__title mr-2">個数</label>
                                    <select id="qty" class="form-control index__card__qty__qty w-40" name="qty">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                            </div>
                            <div class="col-7 index__card__col pull right">
                                <input readonly type="hidden" name="productId" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-info index__card__cart">追加</button>
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
