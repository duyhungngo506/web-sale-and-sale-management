<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //slide
        $slides=Slide::where('id','<>',1)->get();
        $first_slide=Slide::find(1);


        $new_products=Product::where('new',1)->get();
        $sale_products=Product::where('promotion_price','<>',0)->get();

        
        
        $new_products_4item=Product::where('new',1)->paginate(4,['*'],'newpage');
        $sale_products_4item=Product::where('promotion_price','<>',0)->paginate(4,['*'],'toppage');
        
        return view('product.home',compact('new_products_4item','new_products','sale_products','sale_products_4item','slides','first_slide'));
    }

    public function typeProduct($id, $typename)
    {
        $products_new_filter = Product::where('id_type',$id)->where('new',1)->paginate(3,['*'],'newpage');
        $products_new= Product::where('id_type',$id)->where('new',1)->get();
        $products_top_filter = Product::where('id_type',$id)->where('promotion_price','<>',0)->paginate(3,['*'],'salepage');
        $products_top = Product::where('id_type',$id)->where('promotion_price','<>',0)->get();
        
        return view('product.producttype',compact('products_new','products_new_filter','products_top_filter','products_top','typename'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $name='';
         if($request->hasfile('image_file'))
         {
             $file = $request->file('image_file');
             $name=time().'_'.$file->getClientOriginalName();
             $destinationPath=public_path('image/product'); //project\public\car, //public_path(): trả về đường dẫn tới thư mục public
             $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/cars
         }
        $product=new Product();
        $product->name=$request->input('name');
        $product->id_type=$request->input('typeProduct');
        $product->description=$request->input('description');
        $product->unit=$request->input('dvt');
        $product->unit_price=$request->input('unit_price');
        $product->promotion_price=$request->input('promotion_price');
        $product->image=$name;
        $product->new=1;

        $product->save();
        return redirect()->back()->with('success','Bạn đã thêm thành công');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
        return view('product.product-detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product= Product::find($id);
        $name=$product->image;
        if($request->hasfile('image_file'))
        {
            $file = $request->file('image_file');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('image/product'); //project\public\car, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/cars
        }
     
       $product->name=$request->input('name');
       $product->id_type=$request->input('typeProduct');
       $product->description=$request->input('description');
       $product->unit=$request->input('dvt');
       $product->unit_price=$request->input('unit_price');
       $product->promotion_price=$request->input('promotion_price');
       $product->image=$name;

       $product->save();
       return redirect()->back()->with('success','Bạn đã sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('admin.products');
    }
}