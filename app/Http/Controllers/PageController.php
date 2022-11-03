<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function addToCart(Request $request,$id){
    	$product=Product::find($id);
    	$oldCart=Session('cart')?Session::get('cart'):null;
    	$cart=new Cart($oldCart);
    	$cart->add($product,$id);
    	$request->session()->put('cart',$cart);
    	return redirect()->back();
    }
    
    public function delCartItem($id){
    $oldcart = Session::has('cart')?Session::get('cart'):null;
    $cart = new Cart($oldcart);
    $cart->removeItem($id);
    if(count($cart->items)>0){
        Session::put('cart',$cart);
    }
    else{
        Session::forget('cart');
    }
    return redirect()->back();
    }

    public function reduceOne($id){
        $product=Product::find($id);
        $oldcart = Session('cart');
        $cart = new Cart($oldcart);
        $cart->reduceByOne($product,$id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
      
        return redirect()->back();
	}
    public function RaiseOne($id){
        $product=Product::find($id);
        $oldcart = Session('cart');
        $cart = new Cart($oldcart);
        $cart->raiseByOne($product,$id);
        Session::put('cart',$cart);
        return redirect()->back();
	}


	public function postInputEmail(Request $req){
        $email=$req->txtEmail;
        $user=User::where('email',$email)->get();
        if($user->count()!=0){
            $sentData = [
                'title' => 'Thông tin đơn hàng',
                'body' => '123456'
            ];
			
            Mail::to($email)->send(new \App\Mail\SendMail($sentData));
            Session::flash('message', 'Send email successfully!');
            return redirect()->route('login');
        }
        else {
              return redirect()->route('getInputEmail')->with('message','Email không đúng');
        }
    }


  
    public function postCheckout(Request $request){
       if(Session::has('cart')){

        $cart = Session('cart');
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->gender = $request->gender;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone_number = $request->phone_number;
        $customer->note = $request->note;
        $customer->save();
        $bill =  new Bill();
        $bill->id_customer = $customer->id;
        $bill->date_order =date('Y-m-d');
      
        $bill->total = $cart->totalPrice-$request->voucher_value+25000;
      
        $bill->payment = "COD";
        $bill->status = 0;
        $bill->note = $request->note;
        $bill->save();
        foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail();
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = $value['price']/$value['qty'];
            $bill_detail->save();
        }
        
    $sentDataOrder = [
        'title' => 'Thông tin đơn hàng',
        'name' => $customer->name,
        'email' =>  $customer->email,
        'address' =>  $customer->address,
        'phone'=> $customer->phone_number,
        'note'=> $customer->note,
        'bill'=>$cart,
        'voucher'=>$request->voucher_value,
        'total'=>$bill->total,
        'billdetail'=>$cart->items
    ];

    Session::forget('cart');

    $user = Auth::user();

    Mail::to($user->email)->send(new \App\Mail\OrderSuccessMail($sentDataOrder));
    return redirect()->route('home')->with('thongbao','Đặt hàng thành công! Hãy kiểm tra Email');
    }
    else{
        return redirect('/');
    }
       }
  //thay đổi trạng thái yêu thích  
 public function changeWishlist($id){
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $old_wishlist = explode(",", $user->wishlist);
        $strNewIfExist="";
        $strNew=$user->wishlist;
 
        $isExist = false;

        for($i = 0; $i<count($old_wishlist); $i++ ) {
            if(!($id==$old_wishlist[$i])) {
                if($strNewIfExist==""){
                    $strNewIfExist  = $strNewIfExist.$old_wishlist[$i];
                }
                else{
                    $strNewIfExist  = $strNewIfExist.",".$old_wishlist[$i];
                }
            }
            else{
                $isExist = true;
                continue;
            }
        }
        
        if($isExist==false){
            if($strNew==""){
                $strNew  = $strNew.$id;
        }else{
                $strNew  = $strNew.",".$id;
        }
        $user->wishlist = $strNew;
        $user->update();
        }
        else{
            $user->wishlist = $strNewIfExist;
            $user->update();
        }
        return redirect()->back();
       }

       public function applyVoucher(Request $request){
        $voucher = DB::table('vouchers')->where('code',$request->input('coupon_code'))->get();
    
        if(count($voucher)==1){
            return redirect()->back()->with('voucherValue',$voucher[0]->value);
        }
        else{
            return redirect()->back()->with('voucherNotvalid',"Mã giảm giá không hợp lệ");
        }
       
       }

}