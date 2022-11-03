<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Bill::all();
        $billDetails = BillDetail::all();

        return view('admin.bill-list',compact('orders','billDetails'));
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
    public function cancelOrder($id)
    {
        $orderCancel = Bill::find($id);
        $orderCancel->status=4;
        $orderCancel->save();
        return redirect()->back();
    }

    public function deliveryOrder($id)
    {
        $orderDelivery = Bill::find($id);
        $orderDelivery->status=1;
        $orderDelivery->save();
        return redirect()->back();
    }

    public function failedOrder($id)
    {
        $orderFailed = Bill::find($id);
        $orderFailed->status=3;
        $orderFailed->save();
        return redirect()->back();
    }
    public function SuccessOrder($id)
    {
        $orderSuccess = Bill::find($id);
        $orderSuccess->status=2;
        $orderSuccess->save();
        return redirect()->back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}