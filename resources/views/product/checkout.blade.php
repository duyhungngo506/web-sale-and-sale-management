@extends('layout.master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Đặt hàng</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="index.html">Trang chủ</a> / <span>Đặt hàng</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">


            <form action="{{ route('order') }}" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Đặt hàng</h4>
                        <div class="space20">&nbsp;</div>

                        <div class="form-block">
                            <label for="name">Họ tên*</label>
                            <input type="text" name="name" id="name" placeholder="Họ tên"
                                value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="form-block">
                            <label>Giới tính </label>
                            <input id="gender" name="gender" type="radio" class="input-radio" name="gender"
                                value="nam" checked="checked" style="width: 10%"><span
                                style="margin-right: 10%">Nam</span>
                            <input id="gender" name="gender" type="radio" class="input-radio" name="gender"
                                value="nữ" style="width: 10%"><span>Nữ</span>

                        </div>


                        <div class="form-block">
                            <label for="adress">Địa chỉ*</label>
                            <input type="text" name="address" id="adress" value="{{ Auth::user()->address }}"
                                placeholder="Street Address" required>
                        </div>
                        <div class="form-block">
                            <label for="adress">Emali*</label>
                            <input type="text" name="email" id="adress" value="{{ Auth::user()->email }}"
                                placeholder="Email" required>
                        </div>


                        <div class="form-block">
                            <label for="phone">Điện thoại*</label>
                            <input type="text" name="phone_number" value="{{ Auth::user()->phone }}" id="phone"
                                required>
                        </div>

                        <div class="form-block">
                            <label for="notes">Ghi chú</label>
                            <input type="text" id="notes" name="note"></input>
                        </div>


                        <div class="form-block">
                            <input type="number" hidden name="voucher_value"
                                @if (session()->has('voucherValue')) value="{{ session('voucherValue') }}"
                            @else
                            value="0" @endif"></input>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="your-order">
                            <div class="your-order-head">
                                <h5>Đơn hàng của bạn</h5>
                            </div>
                            <div class="your-order-body" style="padding: 0px 10px">
                                @if (Session::has('cart'))
                                    @foreach ($productCarts as $product)
                                        <div class="your-order-item">
                                            <div>
                                                <!--  one item	 -->
                                                <div class="media">
                                                    <img width="25%" src="/image/product/{{ $product['item']['image'] }}"
                                                        alt="" class="pull-left">
                                                    <div class="media-body">
                                                        <p style="margin-top: 2px" class="font-large">
                                                            {{ $product['item']['name'] }}</p>
                                                        <span style="margin-top: 2px" class="color-gray your-order-info">Đơn
                                                            giá:
                                                            @if ($product['item']['promotion_price'] == 0)
                                                                {{ number_format($product['item']['unit_price']) }}
                                                            @else
                                                                {{ number_format($product['item']['promotion_price']) }}
                                                            @endif
                                                            đ
                                                        </span>
                                                        <span style="margin-top: 2px" class="color-gray your-order-info">Số
                                                            lượng:{{ $product['qty'] }} </span>
                                                    </div>
                                                </div>
                                                <!-- end one item -->
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="your-order-item">
                                    <div class="pull-left">
                                        <p class="your-order-f18">Tổng tiền sản phẩm:</p>
                                    </div>
                                    <div class="pull-right">
                                        <h6 class="color-black">
                                            @if (Session::has('cart'))
                                                {{ number_format(Session('cart')->totalPrice) }}
                                            @else
                                                0
                                            @endif
                                            đ
                                        </h6>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="your-order-item">
                                        <div class="pull-left">
                                            <p class="your-order-f18">Phí vận chuyển:</p>
                                        </div>
                                        <div class="pull-right">
                                            <h6 class="color-black">
                                                @if (Session::has('cart'))
                                                    25,000
                                                @else
                                                    0
                                                @endif
                                                đ
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>


                                    @if (session()->has('voucherValue'))
                                        <div class="your-order-item">
                                            <div class="pull-left">
                                                <p class="your-order-f18">Khuyến mãi:</p>
                                            </div>
                                            <div class="pull-right">
                                                <h6 class="color-black">
                                                    -{{ number_format(session('voucherValue')) }}
                                                </h6>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                    @endif


                                    <div class="your-order-item">
                                        <div class="pull-left">
                                            <p class="your-order-f18">Tổng thanh toán:</p>
                                        </div>
                                        <div class="pull-right">
                                            <h6 class="color-black">
                                                @if (Session::has('cart'))
                                                    @if (session()->has('voucherValue'))
                                                        {{ number_format(Session('cart')->totalPrice - session('voucherValue') + 25000) }}
                                                    @else
                                                        {{ number_format(Session('cart')->totalPrice + 25000) }}
                                                    @endif
                                                @else
                                                    0
                                                @endif
                                                đ
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div style="margin-top: 40px" class="text-center"><button
                                            @if (!Session::has('cart')) disabled @endif type="submit"
                                            class="beta-btn primary">Đặt hàng <i class="fa fa-chevron-right"></i></button
                                            type="submit"></div>
                                </div>



                            </div> <!-- .your-order -->
                        </div>
                    </div>
            </form>
            <div class="row form-block">
                <div class="coupon ">
                    <div class="" style="width: 100%; display: flex; justify-content: space-around">
                        <form style="min-width: 650px; margin-left: 30px" action="{{ route('apply-voucher') }}"
                            method="post">
                            @csrf
                            <input type="text" name="coupon_code" value="" placeholder="Nhập mã giảm giá"
                                required>
                            <button style="width: 120px; height: 35px;" type="submit" class="beta-btn primary"
                                name="apply_coupon">Áp dụng
                                <i class="fa fa-chevron-right"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- #content -->

    </div> <!-- .container -->
    </div>
@endsection
