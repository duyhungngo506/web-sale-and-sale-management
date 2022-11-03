@extends('layout.master')


@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Sản phẩm</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="#">Home</a> / Sản phẩm / <span>{{ $typename }}</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-3">
                        <ul class="aside-menu">

                            @foreach ($producttypes as $producttype)
                                <li>
                                    <a
                                        href="{{ route('products.type', [$producttype->id, $producttype->name]) }}">{{ $producttype->name }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="col-sm-9">
                        <div class="beta-products-list">
                            <h4>Sản phẩm mới</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Có {{ count($products_new) }} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach ($products_new_filter as $item)
                                    <div class="col-sm-4">
                                        <div class="single-item">
                                            <div class="single-item-header">
                                                <a href="{{ route('products.show', $item->id) }}"><img style="height: 200px"
                                                        src="/image/product/{{ $item->image }}" alt=""></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{ $item->name }}</p>
                                                <p class="single-item-price">
                                                    @if ($item->promotion_price != 0)
                                                        <span class="flash-del">{{ number_format($item->unit_price) }}
                                                            đ</span>
                                                        <span class="flash-sale">{{ number_format($item->promotion_price) }}
                                                            đ</span>
                                                    @else
                                                        <span class="">{{ number_format($item->unit_price) }} đ</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="shopping_cart.html"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary"
                                                    href="{{ route('products.show', $item->id) }}">Xem chi tiết <i
                                                        class="fa fa-chevron-right"></i></a>
                                                @if (Route::has('login'))
                                                    @auth
                                                        @if (count($productsWishlist) > 0)
                                                            @for ($i = 0; $i < count($productsWishlist); $i++)
                                                                @if ($productsWishlist[$i]->id == $item->id)
                                                                    <a style="margin-left: 14px"
                                                                        href="{{ route('changeWishlist', $item->id) }}"><svg
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
                                                                    href="{{ route('changeWishlist', $item->id) }}">
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
                                                            href="{{ route('changeWishlist', $item->id) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-heart"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                            </svg></a>
                                                    @endif
                                                @else
                                                    <a style="margin-left: 14px"
                                                        href="{{ route('changeWishlist', $item->id) }}">
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
                            {{ $products_new_filter->links() }}
                        </div>
                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>Sản phẩm khuyến mãi</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Có {{ count($products_top) }} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach ($products_top_filter as $item)
                                <div class="col-sm-4">
                                    <div class="single-item">
                                        <div class="single-item-header">
                                            <a href="{{ route('products.show', $item->id) }}"><img
                                                    style="height: 200px" src="/image/product/{{ $item->image }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{ $item->name }}</p>

                                            <p class="single-item-price">
                                                <span class="flash-del">{{ number_format($item->unit_price) }}đ</span>
                                                <span class="flash-sale">{{ number_format($item->unit_price) }}đ</span>
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href="shopping_cart.html"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary"
                                                href="{{ route('products.show', $item->id) }}">Xem chi tiết <i
                                                    class="fa fa-chevron-right"></i></a>
                                            @if (Route::has('login'))
                                                @auth
                                                    @if (count($productsWishlist) > 0)
                                                        @for ($i = 0; $i < count($productsWishlist); $i++)
                                                            @if ($productsWishlist[$i]->id == $item->id)
                                                                <a style="margin-left: 14px"
                                                                    href="{{ route('changeWishlist', $item->id) }}"><svg
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
                                                                href="{{ route('changeWishlist', $item->id) }}">
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
                                                        href="{{ route('changeWishlist', $item->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-heart"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                        </svg></a>
                                                @endif
                                            @else
                                                <a style="margin-left: 14px"
                                                    href="{{ route('changeWishlist', $item->id) }}">
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
                        {{ $products_top_filter->links() }}
                    </div>
                    <div class="space40">&nbsp;</div>

                </div> <!-- .beta-products-list -->
            </div>
        </div> <!-- end section with sidebar and main content -->


    </div> <!-- .main-content -->
</div> <!-- #content -->
</div> <!-- .container -->
@endsection
