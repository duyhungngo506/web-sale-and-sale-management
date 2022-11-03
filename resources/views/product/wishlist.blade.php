@extends('layout.master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Danh sách yêu thích</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="index.html">Trang chủ</a> / <span>Danh sách yêu thích</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">
            <div class="table-responsive">
                <!-- Shop Products Table -->
                <table class="shop_table beta-shopping-cart-table" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="product-name">Sản phẩm</th>
                            <th class="product-price">Giá gốc</th>
                            <th class="product-price">Giá khuyến mãi</th>
                            <th class="product-remove">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productsWishlist as $product)
                            <tr class="cart_item">
                                <td class="product-name">
                                    <div class="media">
                                        <img class="pull-left" width="100px" src="/image/product/{{ $product->image }}"
                                            alt="">
                                        <div class="media-body">
                                            <p class="font-large table-title">{{ $product->name }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="product-price">
                                    <span>
                                        {{ number_format($product->unit_price) }}
                                        đ
                                    </span>
                                </td>
                                <td class="product-price">
                                    <span style="color: red">
                                        @if ($product->promotion_price == 0)
                                        @else
                                            {{ number_format($product->promotion_price) }}đ
                                        @endif

                                    </span>
                                </td>

                                <td class="product-remove">
                                    <a href="{{ route('changeWishlist', $product->id) }}" class="remove"
                                        title="Remove this item"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                    </tbody>
                    @endforeach

                </table>
                <!-- End of Shop Table Products -->

            </div>

            <div class="clearfix"></div>

        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
