@extends('shopper.layout.master')
@section('content')
    <!-- Container fluid Starts -->
    <div class="container-fluid">

        <!-- Top Bar Starts -->
        <div class="top-bar clearfix">
            <div class="row gutter">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="page-title">
                        <h3>Order list</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar Ends -->

        <!-- Row starts -->
        <div class="row gutter">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel">

                    <table class="table table-bordered table-hover">
                        <tr style="background-color: #00B247">
                            <th class="text-center">Product</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Cus_Name</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @foreach($order_info as $item)
                            @foreach($item as $key => $data)
                            <?php  $pro = product_info($key)  ?>
                            <?php $shipping = shipping_info($data) ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="/images/{{$pro->image}}" alt="None" style="width: 100px; height: 100px;">
                                        </td>
                                        <td class="text-center">
                                            {{$pro->name}}
                                        </td>
                                        <td class="text-center">{{$pro->price}}</td>
                                        <td class="text-center">{{$shipping->name}}</td>
                                        <td class="text-center">{{$shipping->phone}}</td>
                                        <td class="text-center">{{$shipping->email}}</td>
                                        <td>
                                            {{getShopperStatus($key)}}
                                        </td>
                                    </tr>
                                @endforeach
                        @endforeach
                    </table>

                </div>
            </div>
        </div>

    </div>
@endsection