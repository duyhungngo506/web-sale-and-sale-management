@extends('layout.master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Giỏ hàng</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="index.html">Trang chủ</a> / <span>Giỏ hàng</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content" style="display: flex;justify-content: space-between">
            @if (Session::has('cart'))
                <div class="table-responsive">
                    <!-- Shop Products Table -->
                    <table class="shop_table beta-shopping-cart-table" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="product-name">Sản phẩm</th>
                                <th class="product-price">Giá</th>
                                <th class="product-quantity">Số lượng</th>
                                <th class="product-subtotal">Tổng</th>
                                <th class="product-remove">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productCarts as $product)
                                <tr class="cart_item">
                                    <td class="product-name">
                                        <div class="media">
                                            <img class="pull-left" width="100px"
                                                src="/image/product/{{ $product['item']['image'] }}" alt="">
                                            <div class="media-body">
                                                <p class="font-large table-title">{{ $product['item']['name'] }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="product-price">
                                        <span>
                                            @if ($product['item']['promotion_price'] == 0)
                                                {{ number_format($product['item']['unit_price']) }}
                                            @else
                                                {{ number_format($product['item']['promotion_price']) }}
                                            @endif
                                            đ
                                        </span>
                                    </td>



                                    <td class="product-quantity">
                                        <div class="quantity buttons_added" style="display: flex">
                                            <a href="{{ route('reduceOne', $product['item']['id']) }}" type="button"
                                                value="-" class="minus">-</a>
                                            <input disabled type="number" min="1" max="" name="quantity"
                                                value="{{ $product['qty'] }}" class="input-text qty text" size="5"
                                                pattern="" inputmode="">
                                            <a href="{{ route('RaiseOne', $product['item']['id']) }}" type="button"
                                                value="+" class="plus">+</a>
                                        </div>
                                    </td>

                                    <td class="product-subtotal">
                                        <span>
                                            @if ($product['item']['promotion_price'] == 0)
                                                {{ number_format($product['qty'] * $product['item']['unit_price']) }}
                                            @else
                                                {{ number_format($product['qty'] * $product['item']['promotion_price']) }}
                                            @endif
                                            đ
                                        </span>
                                    </td>

                                    <td class="product-remove">
                                        <a href="{{ route('delCartItem', $product['item']['id']) }}" class="remove"
                                            title="Remove this item"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                        </tbody>
            @endforeach

            </table>
            <!-- End of Shop Table Products -->

        </div>
        <!-- Cart Collaterals -->
        <div class="cart-totals" style="margin-left: 30px;margin-top: 0">
            <div class="cart-totals-row">
                <h5 class="cart-total-title">Tổng cộng</h5>
            </div>
            <div class="cart-totals-row" style="text-align: center"> <b>
                    @if (Session::has('cart'))
                        {{ number_format(Session('cart')->totalPrice) }}
                    @else
                        0
                    @endif
                    đ
                </b></div>
            <a href="{{ route('checkout') }}"
                style="margin-top: 20px; width: 100%;color:#ffff; background-color: rgb(3, 164, 175)"
                class="beta-btn primary " name="proceed">Đến
                trang thanh
                toán <i class="fa fa-chevron-right"></i></a>
        </div>
        <!-- End of Cart Collaterals -->
    @else
        <h6 class="center">Không có sản phẩm nào trong giỏ hàng!</h6>
        @endif
        <div class="clearfix"></div>

    </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
