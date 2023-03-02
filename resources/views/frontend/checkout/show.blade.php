@extends('frontend.master')


@section('style')
<style>
	.con{
		height:52px important!;
		padding: 10px 15px;
		border-radius: 1px;
		border-color: #e5e5e5;
	}
</style>
@endsection


@section('content')

<!-- ======================= Top Breadcrubms ======================== -->
			<div class="gray py-3">
				<div class="container">
					<div class="row">
						<div class="colxl-12 col-lg-12 col-md-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item"><a href="#">Support</a></li>
									<li class="breadcrumb-item active" aria-current="page">Checkout</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- ======================= Top Breadcrubms ======================== -->
			
			<!-- ======================= Product Detail ======================== -->
			<section class="middle">
				<div class="container">
				
					<div class="row">

						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="text-center d-block mb-5">
								<h2>Checkout</h2>
							</div>
						
						</div>
						
					</div>
					
					<div class="row justify-content-between">
						
						<div class="col-12 col-lg-7 col-md-12">
						@if (session('success'))	
							<div class="mb-3 mt-2 alert alert-success">{{session('success')}}</div>
						@endif
							<form action="{{route('order.store')}}" method="POST">
                                @csrf
								<h5 class="mb-4 ft-medium">Billing Details</h5>
								<div class="row mb-2">
									
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<label class="text-dark">Full Name *</label>
											<input readonly type="text" class="form-control" placeholder="First Name" value="{{Auth::guard('customerlogin')->user()->name}}" />
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">Email *</label>
											<input disabled type="email" class="form-control" placeholder="Email" value="{{Auth::guard('customerlogin')->user()->email}}"/>
										</div>
									</div>
									
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">Company</label>
											<input name="company" type="text" class="form-control" placeholder="Company Name (optional)" />
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">Mobile Number *</label>
											<input name="billing_mobile" type="number" class="form-control" placeholder="Mobile Number" />
										</div>
									</div>
                                    	
								</div>

                                {{-- shipping details --}}
                                <h5 class="mb-4 ft-medium">Shipping Details</h5>
                                    
                                <div class="row">
                                    	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<label class="text-dark">Full Name *</label>
											<input name="name" type="text" class="form-control" placeholder="Shipping Name"/>
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">Email *</label>
											<input name="email" type="email" class="form-control" placeholder="Shipping Email" />
										</div>
									</div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">Mobile Number *</label>
											<input name="shipping_mobile" type="number" class="form-control" placeholder="Mobile Number" />
										</div>
									</div>
                                    						
									<div class="col-xl-7 col-lg-7 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<label class="text-dark">Address *</label>
											<input name="address" type="text" class="form-control" placeholder="Address" value="{{Auth::guard('customerlogin')->user()->address}}"/>
										</div>
									</div>
									
									<div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
										<div  class="con form-group">
											<label class="text-dark">Country *</label>
											<select name="country_id"

											class="country country_select custom-select">
											  <option value="">-- Select Country --</option>
											  @foreach ($countries as $country)
												<option value="{{$country->id}}">{{$country->name}}</option>
											  @endforeach
											</select>
										</div>
									</div>
                                    
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">City / Town *</label>
											<select name="city_id"

											class="city city_two country_select custom-select">
											  <option value="">-- Select City --</option>
											  
											</select>
										</div>
									</div>
									      
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">ZIP / Postcode *</label>
											<input name="zip_code" type="text" class="form-control" placeholder="Zip Code">
										</div>
									</div>
									
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<label class="text-dark">Additional Information</label>
											<textarea name="notes" class="form-control ht-50"></textarea>
										</div>
									</div>
                                </div>	
							
						</div>
						
						<!-- Sidebar -->
						<div class="col-12 col-lg-4 col-md-12">
							<div class="d-block mb-3">
								<h5 class="mb-4">Order Items ({{$carts->count()}})</h5>
								<ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                                    @php
                                       $sub_total = 0; 
                                    @endphp
									@foreach ($carts as $cart)       
									<li class="list-group-item">
										<div class="row align-items-center">
											<div class="col-3">
												<!-- Image -->
												<a href="product.html"><img src="{{asset('uploads/products/preview')}}/{{$cart->rel_with_product->preview}}" alt="..." class="img-fluid"></a>
											</div>
											<div class="col d-flex align-items-center">
												<div class="cart_single_caption pl-2">
													<h4 class="product_title fs-md ft-medium mb-1 lh-1">{{$cart->rel_with_product->product_name}}</h4>

											
													<p class="mb-3 lh-1"><span class="text-dark">Color:{{$cart->rel_with_colors->color_name}} </span></p>
													<h4 class="fs-md ft-medium mb-3 lh-1">&#2547;{{$cart->rel_with_product->after_discount}}</h4>
												</div>
											</div>
										</div>
									</li>
                                    @php
                                        $sub_total += $cart->rel_with_product->after_discount * $cart->quantity
                                    @endphp
									 @endforeach		
								</ul>
							</div>
							
							<div class="mb-4">
								<div class="form-group">
									<h6>Delivery Location</h6>
									<ul class="no-ul-list">
										<li>
											<input id="c1" class="charge radio-custom" name="charge" type="radio" value="60">
											<label for="c1" class="radio-custom-label">Inside City</label>
										</li>
										<li>
											<input id="c2" class="charge radio-custom" name="charge" type="radio" value="150">
											<label for="c2" class="radio-custom-label">Outside City</label>
										</li>
									</ul>
								</div>
							</div>
							<div class="mb-4">
								<div class="form-group">
									<h6>Select Payment Method</h6>
									<ul class="no-ul-list">
										<li>
											<input id="c3" value="1" class="radio-custom" name="payment_method" type="radio">
											<label for="c3" class="radio-custom-label">Cash on Delivery</label>
										</li>
										<li>
											<input id="c4" value="2" class="radio-custom" name="payment_method" type="radio">
											<label for="c4" class="radio-custom-label">Pay With SSLCommerz</label>
										</li>
										<li>
											<input id="c5" value="3" class="radio-custom" name="payment_method" type="radio">
											<label for="c5" class="radio-custom-label">Pay With Stripe</label>
										</li>
									</ul>
								</div>
							</div>
							
							<div class="card mb-4 gray">
							  <div class="card-body">
								<ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                    
									<span>Subtotal</span> <span class="ml-auto text-dark ft-medium">&#2547;{{$sub_total}}</span>
								  </li>
                                   <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Discount</span> <span class="ml-auto text-dark ft-medium">&#2547;{{session('discount')}}</span>
								  </li>
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Charge</span> <span class="ml-auto text-dark ft-medium">&#2547;<span id="charge">0</span></span>
								  </li>
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Total</span> <span class="ml-auto text-dark ft-medium">&#2547;<span id="grand_total">{{$sub_total-session('discount')}}</span>
                                    </span>
								  </li>
								</ul>
							  </div>
							</div>
                            <input type="hidden" name="sub_total" class="sub_total" value="{{$sub_total}}">

                            <input type="hidden" name="discount" class="discount" value="{{session('discount')}}">

							 <input type="hidden" name="grand_total"  value="{{$sub_total-session('discount')}}">
							
							<button class="btn btn-block btn-dark mb-3" type="submit">Place Your Order</button>
						</div>	
					</form>
					</div>
					
				</div>
			</section>
			<!-- ======================= Product Detail End ======================== -->

@endsection


@section('javascript')

<script>
    $('.charge').click(function(){
        let charge = $(this).val();
        let discount = $('.discount').val();
        let sub_total = $('.sub_total').val();
        let total = sub_total - discount + parseInt(charge);
        $('#grand_total').html(total);
        $('#charge').html(charge);
    });

	// select 2
	$(document).ready(function() {
		$('.country_select').select2();
	});
</script>

<script>
		$('.country').change(function(){
			var country_id = $(this).val();

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type:'POST',
				url:'/getCity',
				data:{'country_id' : country_id},
				success:function(data){
					 $('.city').html(data);					
				}
			});
		});
</script>

	
@endsection


	
