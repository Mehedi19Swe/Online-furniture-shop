<?php

use App\product;
use \App\order;
use App\orderProduct;
use App\shipping;
use Illuminate\Support\Facades\DB;

if (!function_exists('product_info')) {

    function product_info($id)
    {
       return product::find($id);

    }
}
if (!function_exists('getOrderStatus')) {

    function getOrderStatus($id)
    {
        $orderStatus = orderProduct::where('order_id',$id)->first();
       if ($orderStatus->shopper_status == 0){
           echo "<p class='bg-success' >Pending</p>";
       }
       elseif ($orderStatus->shopper_status == 1) {
           echo "<p class='bg-primary' >Approved</p>";
       }
       else{
           echo "<p class='bg-danger' >Cancelled</p>";
       }

    }
}

if (!function_exists('getCustomerStatus')) {

    function getCustomerStatus($id)
    {
        $Status = orderProduct::where('product_id',$id)->first();
        if ($Status->cus_status == 0){
            echo "<a href=\"myOrder/$Status->id/update\" onclick=\"return confirm('Are you sure you want to cancel order?');\" class=\"btn btn-success\">Cancel Order</a>";
        }else{
            echo "<a href=\"myOrder/$Status->id/delete\" onclick=\"return confirm('Are you sure you want to Delete this?');\" class=\"btn btn-warning\">Order Cancelled</a>";
        }

    }
}
function shipping_info($id){
    return shipping::where('order_id',$id)->first();
}
function getShopperStatus($id){
    $status = DB::table('order_products')->where('product_id',$id)->orderBy('shopper_status')->first();
    if ($status->shopper_status == 0){
        echo "<a href=\"/order/$status->id/update/status\" class=\"btn btn-success\">Confirm</a>"."  ";
        echo "<a href=\"/order/$status->id/cancel\" onclick=\"return confirm('Are you sure you want to cancel order?');\" class=\"btn btn-danger\">Cancel</a>";
    }
    elseif ($status->shopper_status == 1){
        echo "<a href=\"#\" class=\"btn btn-primary\">Order Confirmed</a>";
    }else{
        echo "<a href=\"#\" class=\"btn btn-warning\">Order Canceled</a>";
    }
}