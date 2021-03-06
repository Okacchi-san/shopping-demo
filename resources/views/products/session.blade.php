@extends('layouts.app')
@section('content')
    <table class="table table-sm">
    <thead>
        <tr>
            <th class="session__table__th" scope="col"></th>
            <th class="session__table__th" scope="col">商品名</th>
            <th class="session__table__th" scope="col">個　数</th>
            <th class="session__table__th" scope="col">価　格</th>
            <th class="session__table__th" scope="col">小　計</th>
            <th class="session__table__th" scope="col"></th>
        </tr>
    </thead>
    <tbody>
    @php
        $rowId = 0;
        $total = 0;
        $tax = 0;
        $sum_qty = 0;
        $product = null;
    @endphp
    @if (session()->has('cart'))
    
        @foreach ($cart as $product)
            <tr>
                <th class="session__table__th py-auto" scope="row">{{ ++$rowId }}</th>
                <td class="session__table__td">{{ $product[0]['name'] }}</td>
                <td class="session__table__td">&emsp;&emsp;
                    {{ $product[0]['qty'] }}
                    <span class="form-inline">&emsp;
                    <form action='{{ route('session.update') }}' method="POST">
                        {{ method_field('put') }}
                        {{ csrf_field() }}
                            <input readonly type="hidden" name="productIdInc" value="{{ $product[0]['id'] }}">
                            <button type="submit" class="btn session__btn__update">＋</button>
                    </form>
                    <form action='{{ route('session.update') }}' method="POST">
                        {{ method_field('put') }}
                        {{ csrf_field() }}
                            <input readonly type="hidden" name="productIdDec" value="{{ $product[0]['id'] }}">
                            <button type="submit" class="btn session__btn__update">ー</button>
                    </form>
                    </span>
                </td>
                <td class="session__table__td__amount">{{ $product[0]['amount'] }}円</td>
                @php
                    $subTotal = $product[0]['qty']*$product[0]['amount'];
                    $qty = $product[0]['qty']
                @endphp
                <td class="session__table__td">{{ $subTotal }}円</td>
                <td class="text-center">
                    <form action='{{ route('session.delete') }}' method="POST">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                            <input readonly type="hidden" name="productId" value="{{ $product[0]['id'] }}">
                            <button type="submit" class="btn btn-danger btn-sm session__btn">削除</button>
                    </form>
                </td>
            </tr>
            @php
                $total += $subTotal;
                $tax = $total*0.08;
                $sum_qty += $product[0]['qty'];
            @endphp
        @endforeach   
    @else
        <p>セッションに保存されていません。</p>
        
    @endif
    </tbody>
    </table>    
    <div class="container mt-5">
        <div class="row">
            <div class="col-8">
            </div>
            <div class="col-3">
            <div class="card" style="width: 15rem;">
                <div class="card-header text-center"><small class="text-muted">お買い上げ金額　<spn class=session__items_count>アイテム数：{{ $sum_qty }}個</spn></small></div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-right"><small class="text-muted">小　計：　　{{ $total }}円</small></li>
                    <li class="list-group-item text-right"><small class="text-muted">消費税：　　{{ $tax }}円</small></li>
                    <li class="list-group-item text-right"><small class="text-muted">合　計：　　{{ $total+$tax }}円</small></li>
                    <div class="list-group-item text-center">
                        <form action='{{ route('charge.post') }}' method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
          	                <input readonly type="hidden" class="form-control" name="total" value="{{ $total+$tax }}">
                        </div>
                        <div class="form-group">
          	                <input readonly type="hidden" class="form-control" name="productId" value="{{ $product[0]['id'] }}">
                        </div>
                        @if (empty($cart))
                        <a href="#" class="btn btn-success btn-sm disabled">決済をする</a>
                        @else
                        <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="{{ env('STRIPE_APP_OPENKEY') }}"
                            data-amount="{{ $total+$tax }}"
                            data-name="TEST"
                            data-label="決済をする"
                            data-description="TESTTEST"
                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                            data-locale="ja"
                            data-currency="jpy">
                        </script>
                        @endif
                        </form>
                    </div>
                </ul>
            </div>  
            </div>
        </div>
    </div>
@endsection


  