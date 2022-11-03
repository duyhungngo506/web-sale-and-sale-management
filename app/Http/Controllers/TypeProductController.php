<?php

namespace App\Http\Controllers;

use App\Models\TypeProduct;
use Illuminate\Http\Request;

class TypeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeproducts = TypeProduct::all();
        return view('admin.typeproduct-list',compact('typeproducts'));
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
        $typeproduct= new TypeProduct();
        $name="";
        if($request->hasfile('image_file'))
        {
            $file = $request->file('image_file');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('image/product'); //project\public\car, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/cars
        }
     
       $typeproduct->name=$request->input('name');
       $typeproduct->description=$request->input('description');
       $typeproduct->image=$name;

       $typeproduct->save();
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
        //
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
        $typeproduct= TypeProduct::find($id);
        $name=$typeproduct->image;
        if($request->hasfile('image_file'))
        {
            $file = $request->file('image_file');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('image/product'); //project\public\car, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/cars
        }
     
       $typeproduct->name=$request->input('name');
       $typeproduct->description=$request->input('description');
       $typeproduct->image=$name;

       $typeproduct->save();
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
        TypeProduct::find($id)->delete();
        return redirect()->back();
    }
}