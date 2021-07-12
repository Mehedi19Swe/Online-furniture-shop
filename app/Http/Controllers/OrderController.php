<?php

namespace App\Http\Controllers;

use App\order;
use App\orderProduct;
use App\product;
use App\shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = DB::table('orders')->where('customer_id',auth()->user()->id)->pluck('id');
        $order_product = orderProduct::wherein('order_id',$order)->pluck('order_id','product_id');
        return view('customer.order',compact('order_product','order'));
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
        $cart = session()->get('cart');


        $total = 0;
        foreach ($cart as $data) {
            $total_price = $data['price'] * $data['quantity'];
            $qty = $data['quantity'];
        }
        $quantity = $qty + 0;

        $oder = new order();

        $oder->customer_id = auth()->user()->id;
        $oder->payment = $request['payment'];
        $oder->total_qty = $quantity;
        $oder->total_price = $total_price;
        $oder->status = 0;
        $oder->save();

        $order_id = DB::getPdo()->lastInsertId();

        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $ship = new shipping();

        $ship->name = $request->name;
        $ship->address = $request->address;
        $ship->country = $request->country;
        $ship->phone = $request->phone;
        $ship->email = $request->email;
        $ship->order_id = $order_id;
        $ship->save();

        foreach ($cart as $data) {
            $qty = $data['quantity'];
            $OrderPro = new orderProduct();
            $OrderPro->order_id = $order_id;
            $OrderPro->product_id = $data['id'];
            $OrderPro->pro_name = $data['name'];
            $OrderPro->pro_price = $data['price'];
            $OrderPro->product_qty = $qty;
            $OrderPro->save();
        }
        session()->forget('cart');
        return redirect('customer')->with('success','Your Order has been placed successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update($order)
    {
       $ordr = orderProduct::find($order);
       if ($ordr->cus_status == 0){
           $ordr->cus_status = 1;
       }
        $ordr->save();
       return redirect()->back()->with('success','Order is Cancelled Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($order)
    {
        $ordr = orderProduct::find($order);
        $ordr->delete();
        return redirect()->back()->with('success','Product deleted Successfully.');
    }

    public function orderList($id)
    {
        $myProduct = product::where('shopper',$id)->get();
        $orderProduct = orderProduct::all();
        $order_info = array();
        foreach ($myProduct as $product){
            foreach ($orderProduct as $order){
                if ($product->id == $order->product_id){
                    $order_info[] = orderProduct::where('product_id',$product->id)
                        ->pluck('order_id','product_id');
                }
            }
        }
        return view('shopper.order',compact('order_info'));
    }

    public function ConfirmOrder($id)
    {
        $orderStatus = orderProduct::find($id);
        $orderStatus->shopper_status = 1;
        $orderStatus->save();
        return redirect()->back()->with('success','Order is confirmed');
    }
    public function cancelOrder($id){
        $orderStatus = orderProduct::find($id);
        $orderStatus->shopper_status = 5;
        $orderStatus->save();
        return redirect()->back()->with('success','Order is cancelled.');
    }
}
