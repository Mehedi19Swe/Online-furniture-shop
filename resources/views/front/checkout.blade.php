@extends('front.layout.master')
@section('content')
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 ftco-animate">

			<form action="{{route('order.store')}}" method="post" class="billing-form">
				<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
				<h3 class="mb-4 billing-heading">Shipping Details</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-6">
						<div class="form-group">
							<label for="firstname">Full Name</label>
						  <input type="text" name="name" class="form-control" placeholder="Full Name">
						</div>
	                </div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="address">Address</label>
	                  <input type="text" name="address" class="form-control" placeholder="Full Address">
	                </div>
		            </div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="country">Country</label>
							<input type="text" name="country" class="form-control" placeholder="Country">
						</div>
					</div>
		            <div class="col-md-6">
	                <div class="form-group">
	                	<label for="phone">Phone</label>
	                  <input type="number" name="phone" class="form-control" placeholder="Phone Number">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="email">Email Address</label>
	                  <input type="email" name="email" class="form-control" placeholder="">
	                </div>
                </div>
				</div>
	            <!-- END -->
					</div>
					<div class="col-xl-5">
	           <div class="row mt-5 pt-3">
	          	 <div class="col-md-12 d-flex mb-5">
	          		<div class="cart-detail cart-total p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Cart Total</h3>
						<?php $total=0; ?>
						@if(session('cart'))
							@foreach(session('cart') as $id => $details)
								<?php $total += $details['price'] * $details['quantity'] ?>
							@endforeach
						@endif
	          			<p class="d-flex">
		    						<span>Subtotal</span>
		    						<span>৳{{$total}}</span>
		    					</p>
		    					<p class="d-flex">
		    						<span>Delivery</span>
		    						<span>৳50.00</span>
		    					</p>
		    					<hr>
		    					<p class="d-flex total-price">
											<span>Total</span>
		    						<span>৳{{$total+50}}</span>
		    					</p>
								</div>
	          	</div>
	          	<div class="col-md-12">
	          		<div class="cart-detail p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="payment" value="Cash on delivery" required>Cash On Delivery</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="checkbox">
											   <label><input type="checkbox" value="" class="mr-2" required> I have read and
												   accept the terms and conditions</label>
											</div>
										</div>
									</div>

						          <input type="submit" value="Place Order" class="btn btn-primary py-3 px-4">
								</div>
					</form>
	          	</div>
	          </div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->
@endsection
