<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" rel="stylesheet">
    <link href="{{ asset('css/style.css' )}}" rel="stylesheet" type="text/css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ('Shopping-Demo') }}</title>

    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--> 
</head>
    @php
        $rowId = 0;
        $total = 0;
        $tax = 0;
        $sum_qty = 0;
    @endphp
    @foreach ($cart as $product)
    @php
        $subTotal = $product[0]['qty']*$product[0]['amount'];
        $qty = $product[0]['qty']
    @endphp
    @php
        $total += $subTotal;
        $tax = $total*0.08;
        $sum_qty += $product[0]['qty'];
    @endphp
    @endforeach
<body>
    <p>領収書</p>
    <p>{{ Auth::user()->name }}　様</p>
    <p class="index__card__title">¥{{ $total+$tax }}-</p>
    <p class="index__card__description">但し　商品代として上記金額を受領いたしました。</p>
    <div class="card-header">商品名/仕様</div>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th class="session__table__th" scope="col">商品番号</th>
                    <th class="session__table__th" scope="col">商品名</th>
                    <th class="session__table__th" scope="col">個数</th>
                    <th class="session__table__th" scope="col">単価</th>
                    <th class="session__table__th" scope="col">小計</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $product) 
                @php
                    $subTotal = $product[0]['qty']*$product[0]['amount'];
                    $qty = $product[0]['qty']
                @endphp
                <tr>
                    <th class="session__table__th py-auto" scope="row">{{ $product[0]['id'] }}</th>
                    <td class="session__table__td">{{ $product[0]['name'] }}</td>
                    <td class="session__table__td">{{ $qty }}</td>
                    <td class="session__table__td">{{ $product[0]['amount'] }}円</td>
                    <td class="session__table__td">{{ $subTotal }}円</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    <p>小　計：　　{{ $total }}円</p>
    <p>消費税：　　{{ $tax }}円</p>
    <p>合　計：　　{{ $total+$tax }}円</p>
    <p>お支払い方法：クレジットカード</p>
</body>
</html>

