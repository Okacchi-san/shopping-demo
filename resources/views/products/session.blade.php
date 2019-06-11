@extends('layouts.app')
@section('content')

    @if (isset($product) and count($product) > 0)
    
        @foreach ($product as $product)
    
        <p>商品名：　{{ $product->name }}</p>
        <p>個　数：　</p>
        <p>価　格：　{{ $product->amount }}円</p>
        
        @endforeach   
        <p>{{ $count_products }}</p>
    @else
        <p>セッションに保存されていません。</p>
    @endif

@endsection  