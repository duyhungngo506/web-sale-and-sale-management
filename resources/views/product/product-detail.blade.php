@extends('layout.master')
@section('css')
    <link href="http://fonts.googleapis.com/css?family=Dosis:300,400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/dest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/assets/dest/vendors/colorbox/example3/colorbox.css" />
    <link rel="stylesheet" title="style" href="/assets/dest/css/style.css" />
    <link rel="stylesheet" href="/assets/dest/css/animate.css" />
    <link rel="stylesheet" title="style" href="/assets/dest/css/huong-style.css" />
@endsection

@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Chi tiết sản phẩm</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="index.html">Trang chủ</a> / <span>Sản phẩm</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="/image/product/{{ $product->image }}" alt="" />
                        </div>
                        <div class="col-sm-8">
                            <div class="single-item-body">
                                <p class="single-item-title" style="font-weight: bold">
                                    {{ $product->name }}
                                </p>
                                <p class="single-item-price">
                                    @if ($product->promotion_price == 0)
                                        <span>{{ number_format($product->unit_price) }}đ</span>
                                    @else
                                        <span class="flash-del">{{ number_format($product->unit_price) }}đ</span>
                                        <span class="flash-sale">{{ number_format($product->promotion_price) }}đ</span>
                                    @endif
                                </p>
                            </div>

                            <div class="clearfix"></div>
                            <div class="space20">&nbsp;</div>

                            <div class="single-item-desc">
                                <p>
                                    {{ $product->description }}
                                </p>
                            </div>
                            <div class="space20">&nbsp;</div>

                            <a class=""
                                style="background-color: #EE9F1F; padding: 15px 20px; color: #ffff; font-weight: bold; margin: 40px 0 0 70px"
                                href="{{ route('addToCart', $product->id) }}">Thêm vào giỏ
                                hàng</a>

                        </div>
                    </div>

                    <div class="space40">&nbsp;</div>
                    <div class="woocommerce-tabs">
                        <ul class="tabs">
                            <li>
                                <a href="#tab-description">Mô tả sản phẩm</a>
                            </li>
                            <li><a href="#tab-reviews">Đánh giá (0)</a></li>
                        </ul>

                        <div class="panel" id="tab-description">
                            <p>
                                {{ $product->description }}
                            </p>
                            <p>
                            </p>
                        </div>
                        <div class="panel" id="tab-reviews">
                            <p>No Reviews</p>
                        </div>
                    </div>
                    <div class="space50">&nbsp;</div>

                </div>

            </div>
        </div>
        <!-- #content -->
    </div>
    <!-- .container -->
@endsection
