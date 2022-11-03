<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> 2 Bàu Trảng 7, Thanh Khê Tây, Thanh Khê, Đà
                            Nẵng</a>
                    </li>
                    <li><a href=""><i class="fa fa-phone"></i> 0387469506</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                {{-- <li><a href="#"><i class="fa fa-user"></i>Tài khoản</a></li> --}}
                @if (Route::has('login'))
                    <ul class="top-details menu-beta l-inline">
                        @auth
                            <li>
                                <a href="#">{{ Auth::user()->name }}</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button style="height: 46px; border: none; padding: 0 10px" type="submit">Đăng
                                        xuất</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">Đăng nhập</a></li>

                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}">Đăng kí</a></li>
                            @endif
                        @endauth
                    </ul>
                @endif

            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="{{ route('home') }}" id="logo"><img src="/image/logo.jpg" width="200px"
                        alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp" style="width: 200px; text-align: center; margin-top: -2px">
                    <a style="margin-left: 14px;line-height: 44px;font-size: 1.2 em;border: 1px solid #ccc; padding: 8px;text-decoration: none"
                        href="{{ route('wishlist') }}"><svg style="margin-right: 4px" xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path
                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>Yêu thích (
                        @auth
                            @if (count($productsWishlist) > 0)
                                {{ count($productsWishlist) }}
                            @else
                                Trống
                            @endif
                        @else
                            Trống
                        @endauth
                        )
                    </a>
                </div>

                <div class="beta-comp">
                    <div class="cart">
                        <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                            @if (Session::has('cart'))
                                {{ Session('cart')->totalQty }}
                            @else
                                (Trống)
                            @endif
                            <i class="fa fa-chevron-down"></i>
                        </div>
                        @if (Session::has('cart'))
                            <div class="beta-dropdown cart-body">

                                @if (Session::has('cart'))
                                    @foreach ($productCarts as $product)
                                        <div class="cart-item  d-flex ">
                                            <div class="media">
                                                <a class="pull-left" href="#"><img
                                                        src="/image/product/{{ $product['item']['image'] }}"
                                                        alt=""></a>
                                                <div class="media-body">
                                                    <span class="cart-item-title">{{ $product['item']['name'] }}</span>
                                                    <span class="cart-item-amount">{{ $product['qty'] }} x
                                                        <span>
                                                            @if ($product['item']['promotion_price'] == 0)
                                                                {{ number_format($product['item']['unit_price']) }}
                                                            @else
                                                                {{ number_format($product['item']['promotion_price']) }}
                                                            @endif
                                                            đ
                                                        </span></span>
                                                </div>


                                            </div>
                                            <a class="pull-right "
                                                style="margin-top: -40px;margin-right:20px;color:red;
                                            font-weight:bold"
                                                href="{{ route('delCartItem', $product['item']['id']) }}">X</a>
                                        </div>
                                    @endforeach


                                @endif

                                <div class="cart-caption">
                                    <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">
                                            @if (Session::has('cart'))
                                                {{ number_format(Session('cart')->totalPrice) }}
                                            @endif
                                            đ
                                        </span></div>
                                    <div class="clearfix"></div>
                                    <div class="center">
                                        <Sdiv class="space10">&nbsp;</Sdiv>
                                        <a href="{{ route('shoppingcart') }}" class="beta-btn primary text-center"
                                            style="width: 150px">Xem giỏ hàng <i class="fa fa-chevron-right"></i></a>
                                    </div>
                                    <div class="center">
                                        <div class="space10">&nbsp;</div>
                                        <a href="{{ route('checkout') }}" class="beta-btn primary text-center"
                                            style="width: 150px">Đặt hàng <i class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div> <!-- .cart -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #EE9F1F;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span
                    class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li style="margin-right: 10px"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li style="margin-right: 10px"><a href="#">Sản phẩm</a>
                        <ul class="sub-menu">

                            @foreach ($producttypes as $producttype)
                                <li><a
                                        href="{{ route('products.type', [$producttype->id, $producttype->name]) }}">{{ $producttype->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li style="margin-right: 10px"><a href="{{ route('about') }}">Giới thiệu</a></li>
                    <li style="margin-right: 10px"><a href="{{ route('contact') }}">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
</div> <!-- #header -->
