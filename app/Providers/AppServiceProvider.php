<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\TypeProduct;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['product.home','product.producttype','product.product-detail','product.about','product.checkout','product.contact','product.signup','product.login','product.input-email','product.wishlist','admin.product-list','product.shopping_cart'], function ($view) {
            $producttypes = TypeProduct::all();
            $view->with('producttypes',$producttypes);
        });
        Paginator::useBootstrapFour();
       

        View::composer(['admin.product-list'], function ($view) {
            $products = Product::all();
            $view->with('products',$products);
        });
       

        View::composer(['layout.header','product.checkout','product.shopping_cart'],function($view){
            if(Session('cart')){
                $oldCart=Session::get('cart'); //session cart được tạo trong method addToCart của PageController
                $cart=new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'productCarts'=>$cart->items,
                'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        });

        View::composer(['product.home','product.producttype','product.product-detail','product.about','product.checkout','product.contact','product.signup','product.login','product.input-email','admin.product-list','product.shopping_cart','product.wishlist'], function ($view) {
            if(Auth::check()){
                $wishlist = explode(",",Auth::user()->wishlist);
                $productsWishlist = DB::table('products')
                ->whereIn('id', $wishlist)->get();
                $view->with('productsWishlist',$productsWishlist);
            }
           
        });

      
    }
}