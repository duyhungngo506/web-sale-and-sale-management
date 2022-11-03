<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user-list',compact('users'));
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
        //
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
        $this->validate($request, 
            [
                //Kiểm tra giá trị rỗng
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'phone' => 'required',
               
            ],
            [
                //Tùy chỉnh hiển thị thông báo
                'name.required' => 'Bạn chưa nhập tên!',
                'email.required' => 'Bạn chưa nhập email!',
                'address.required' => 'Bạn chưa nhập địa chỉ!',
                'phonew.required' => 'Bạn chưa nhập số điện thoại!',
              
            ]        
        );


        $user = User::find($id);
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->address=$request->input('address');
        $user->phone=$request->input('phone');
        $user->level=$request->input('level');
       $user->save();

        return redirect('admin') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin');
    }
}