<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-light bg-light"> 
        <a class="navbar-brand nav__brand" href="/admin/home">Shopping-Demo</a>
         
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item nav__title">{!! link_to_route('admin_product.get', '商品一覧', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item nav__title">{!! link_to_route('admin_session.get', 'Myカート', [], ['class' => 'nav-link']) !!}</li>
                        <h6 class="my-auto mr-2">
                            <span class="badge badge-info nav__badge mr-1">
                                @php
                                $sum_qty = 0;
                                @endphp
                                @if(session()->has('cart'))
                                    @foreach ($cart as $product)
                                        @php
                                            $qty = $product[0]['qty'];
                                            $sum_qty += $product[0]['qty'];
                                        @endphp
                                    @endforeach
                                    {{ $sum_qty }}
                                @else
                                    {{ 0 }}
                                @endif        
                            </span>
                        </h6>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle nav__title" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item nav__title__out"><a href="#">My profile</a></li>
                            <li class="dropdown-divider nav__title"></li>
                            <li class="dropdown-item nav__title__out">{!! link_to_route('admin_logout_get', 'Logout') !!}</li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item nav__title">{!! link_to_route('admin_login', 'Login', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>