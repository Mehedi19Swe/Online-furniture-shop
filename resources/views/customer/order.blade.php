@extends('customer.layout.master')
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

                    <table class="table table-bordered">
                        <tr style="background-color: #00B247">
                            <th class="text-center">Product</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @foreach($order_product as $key =>$id)
                            <?php $pro = product_info($key); ?>
                            <tr>
                                <td class="text-center">
                                    <img src="/images/{{$pro->image}}" alt="None" style="width: 100px; height: 100px;">
                                </td>
                                <td class="text-center">{{$pro->name}}</td>
                                <td class="text-center">{{$pro->price}}</td>
                                <td class="text-center">{{getOrderStatus($id)}}</td>
                                <td class="text-center">{{getCustomerStatus($key)}}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
            <div class="pagination">

            </div>
        </div>

    </div>
@endsection