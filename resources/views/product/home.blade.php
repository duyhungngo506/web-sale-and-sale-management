@extends('layout.master')
@section('css')
    <style>
        .popup {
            background-color: #ffffff;
            width: 420px;
            padding: 30px 40px;
            position: fixed;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
            border-radius: 8px;
            font-family: "Poppins", sans-serif;
            display: none;
            text-align: center;
            box-shadow: 5px 5px 30px rgba(0, 0, 0, .2);
            z-index: 1000;
        }

        h2 {
            margin-top: 10px;
            font-size: 25px;
        }

        .popup button {
            display: block;
            position: absolute;
            top: 0;
            right: 0;
            margin: 10px 10px auto;
            background-color: transparent;
            font-size: 30px;
            color: #f3e4e4;
            background: #f06c6c;
            border-radius: 100%;
            width: 40px;
            height: 40px;
            border: none;
            outline: none;
            cursor: pointer;
        }

        .popup p {
            font-size: 14px;
            text-align: justify;
            margin: 20px 0;
            line-height: 25px;
        }

        #alink {
            display: block;
            width: 150px;
            position: relative;
            margin: 10px auto;
            font-size: 17px;
            text-align: center;
            background-color: red;
            border-radius: 10px;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 0;
        }

        .icon1 {
            font-size: 60px;
            background: red;
            height: 120px;
            width: 120px;
            color: white;
            border-radius: 50%;
            line-height: 120px;
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div class="rev-slider">
        <div class="fullwidthbanner-container">
            <div class="fullwidthbanner">
                <div class="bannercontainer">
                    <div class="banner">
                        <ul>
                            <!-- THE FIRST SLIDE -->
                            <li data-transition="boxfade" data-slotamount="20" class="active-revslide"
                                style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                                <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined"
                                    data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined"
                                    data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined"
                                    data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined"
                                    data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined"
                                    data-oheight="undefined">
                                    <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover"
                                        data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined"
                                        src="/image/slide/{{ $first_slide->image }}"
                                        data-src="/image/slide/{{ $first_slide->image }}"
                                        style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('/image/slide/{{ $first_slide->image }}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                                    </div>
                                </div>

                            </li>

                            @foreach ($slides as $slide_item)
                                <li data-transition="boxfade" data-slotamount="20" class="active-revslide"
                                    style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                                    <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined"
                                        data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined"
                                        data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined"
                                        data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined"
                                        data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined"
                                        data-oheight="undefined">
                                        <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover"
                                            data-bgposition="center center" data-bgrepeat="no-repeat"
                                            data-lazydone="undefined" src="/image/slide/{{ $slide_item->image }}"
                                            data-src="/image/slide/{{ $slide_item->image }}"
                                            style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('/image/slide/{{ $slide_item->image }}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                                        </div>
                                    </div>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <div class="tp-bannertimer"></div>
            </div>
        </div>
        <!--slider-->
    </div>

    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <h4>Sản phẩm mới</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Có {{ count($new_products) }} sản phẩm mới</p>
                                <div class="clearfix"></div>
                            </div>


                            <div class="row">
                                @foreach ($new_products_4item as $new_product)
                                    <div class="col-sm-3" style="margin-top: 40px">
                                        <div class="single-item">
                                            @if ($new_product->promotion_price != 0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{ route('products.show', $new_product->id) }}"><img
                                                        src="/image/product/{{ $new_product->image }}" alt=""
                                                        width="270px" height="200px"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{ $new_product->name }}</p>
                                                <p class="single-item-price">
                                                    @if ($new_product->promotion_price != 0)
                                                        <span
                                                            class="flash-del">{{ number_format($new_product->unit_price) }}
                                                            đ</span>
                                                        <span
                                                            class="flash-sale">{{ number_format($new_product->promotion_price) }}
                                                            đ</span>
                                                    @else
                                                        <span class="">{{ $new_product->unit_price }} đ</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div style="margin-top: 10px" class="single-item-caption">
                                                <a class="add-to-cart pull-left"
                                                    href="{{ route('addToCart', $new_product->id) }}"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary"
                                                    href="{{ route('products.show', $new_product->id) }}">Xem chi tiết <i
                                                        class="fa fa-chevron-right"></i></a>
                                                @if (Route::has('login'))
                                                    @auth
                                                        @if (count($productsWishlist) > 0)
                                                            @for ($i = 0; $i < count($productsWishlist); $i++)
                                                                @if ($productsWishlist[$i]->id == $new_product->id)
                                                                    <a style="margin-left: 14px"
                                                                        href="{{ route('changeWishlist', $new_product->id) }}"><svg
                                                                            xmlns="http://www.w3.org/2000/svg" width="16"
                                                                            height="16" fill="currentColor"
                                                                            class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd"
                                                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                                                        </svg></a>
                                                                @break
                                                            @endif

                                                            @if (count($productsWishlist) == $i + 1)
                                                                <a style="margin-left: 14px"
                                                                    href="{{ route('changeWishlist', $new_product->id) }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-heart" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                                    </svg></a>
                                                            @endif
                                                        @endfor
                                                    @else
                                                        <a style="margin-left: 14px"
                                                            href="{{ route('changeWishlist', $new_product->id) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-heart"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                            </svg></a>
                                                    @endif
                                                @else
                                                    <a style="margin-left: 14px"
                                                        href="{{ route('changeWishlist', $new_product->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-heart"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                        </svg></a>
                                                @endauth
                                            @endif
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <div class="row pager">
                            {{ $new_products_4item->links() }}
                        </div>

                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>Sản phẩm khuyến mãi</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Có {{ count($sale_products) }} sản phẩm khuyến mãi</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach ($sale_products_4item as $sale_product)
                                <div class="col-sm-3">
                                    <div class="single-item">
                                        <div class="ribbon-wrapper">
                                            <div class="ribbon sale">Sale</div>
                                        </div>
                                        <div class="single-item-header">
                                            <a href="{{ route('products.show', $sale_product->id) }}"><img
                                                    src="/image/product/{{ $sale_product->image }}" alt=""
                                                    width="270px" height="200px"></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{ $sale_product->name }}</p>
                                            <p class="single-item-price">
                                                <span class="flash-del">{{ $sale_product->unit_price }}đ</span>
                                                <span class="flash-sale">{{ $sale_product->promotion_price }}đ</span>
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left"
                                                href="{{ route('addToCart', $sale_product->id) }}"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary"
                                                href="{{ route('products.show', $sale_product->id) }}">Xem chi tiết <i
                                                    class="fa fa-chevron-right"></i></a>
                                            @if (Route::has('login'))
                                                @auth
                                                    @if (count($productsWishlist) > 0)
                                                        @for ($i = 0; $i < count($productsWishlist); $i++)
                                                            @if ($productsWishlist[$i]->id == $sale_product->id)
                                                                <a style="margin-left: 14px"
                                                                    href="{{ route('changeWishlist', $sale_product->id) }}"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                                        <path fill-rule="evenodd"
                                                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                                                    </svg></a>
                                                            @break
                                                        @endif

                                                        @if (count($productsWishlist) == $i + 1)
                                                            <a style="margin-left: 14px"
                                                                href="{{ route('changeWishlist', $sale_product->id) }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-heart" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                                </svg></a>
                                                        @endif
                                                    @endfor
                                                @else
                                                    <a style="margin-left: 14px"
                                                        href="{{ route('changeWishlist', $sale_product->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-heart"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                        </svg></a>
                                                @endif
                                            @else
                                                <a style="margin-left: 14px"
                                                    href="{{ route('changeWishlist', $sale_product->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-heart"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                    </svg></a>
                                            @endauth
                                        @endif
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="row pager">
                            {{ $sale_products_4item->links() }}
                        </div>
                    </div>
                    <div class="space40">&nbsp;</div>

                </div> <!-- .beta-products-list -->
            </div>
        </div> <!-- end section with sidebar and main content -->


    </div> <!-- .main-content -->
</div> <!-- #content -->
</div> <!-- .container -->
@if (session()->has('thongbao'))
<div class="popup">


    <div><img width="200px" src="./image/logo.jpg" alt=""></div>
    <button id="close">&times;</button>


    <h2> <b>Hưng Bakery</b> </h2>
    <p>
        Bạn đã đặt hàng thành công! Hãy xem chi tiết đơn hàng tại hộp thư của bạn!
    </p>

</div>
@endif
<script type="text/javascript">
    window.addEventListener("load", function() {
        setTimeout(
            function open(event) {
                document.querySelector(".popup").style.display = "block";
            },
            1000
        )
    });


    document.querySelector("#close").addEventListener("click", function() {
        document.querySelector(".popup").style.display = "none";
    });
</script>
@endsection
