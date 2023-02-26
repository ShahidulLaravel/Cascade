@extends('frontend.master')


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
									<li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			
			<!-- ======================= Product Detail ======================== -->
			<section class="middle">
				<div class="container">
				
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="text-center d-block mb-5">
								<h2>Shopping Cart</h2>
							</div>
						</div>
					</div>

					
					
					
					<div class="row justify-content-between">
						<div class="col-12 col-lg-7 col-md-12">
							
							<form action="{{route('update.cart')}}" method="POST">
								@csrf
								<ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
									@php
										$sub_total = 0;
									@endphp

								@foreach (App\Models\Cart::where('customer_id', Auth::guard('customerlogin')->id())->get() as $product)
                                    <li class="list-group-item">
									<div class="row align-items-center">
										<div class="col-3">
											<!-- Image -->
											<a href="product.html"><img src="{{asset('uploads/products/preview')}}/{{$product->rel_with_product->preview}}" alt="..." class="img-fluid"></a>
										</div>
										<div class="col d-flex align-items-center justify-content-between">
											<div class="cart_single_caption pl-2">
												<h4 class="product_title fs-md ft-medium mb-1 lh-1">{{$product->rel_with_product->product_name}}</h4>
												<p class="mb-1 lh-1"><span class="text-dark"></span></p>
												<p class="mb-3 lh-1"><span class="text-dark">Color: {{$product->rel_with_colors->color_name}}</span></p>

												<h4 class="fs-md ft-medium mb-3 lh-1">&#2547;{{$product->rel_with_product->after_discount}}</h4>

											
												
												<select name="quantity[{{$product->id}}]" class="mb-2 custom-select w-auto">		 				 											
												@for ($i = 1; $i <= 10; $i++)
													<option  value="{{$i}}" {{$product->quantity == $i ? 'selected' : ''}}>{{$i}}</option>
												  @endfor
												</select>

											</div>
											<div class="fls_last"><a href="{{route('cart.remove', $product->id)}}" class="close_slide gray"><i class="ti-close"></i></a></div>
										</div>
									</div>
								</li>
								@php
									$sub_total += $product->rel_with_product->after_discount * $product->quantity;
								@endphp

                                @endforeach
								
							</ul>
																		
							<div class="row align-items-end justify-content-between mb-10 mb-md-0">
								
								<div class="col-12 col-md-auto mfliud">
									<button class="btn stretched-link borders">Update Cart</button>
								</div>
							</form>
							</div>
					
						</div>
						
						<div class="col-12 col-md-12 col-lg-4">
							@if(session('warn_one'))
								<div class="alert alert-danger">
									{{session('warn_one')}}
								</div>
							@endif
							@if(session('warn_two'))
								<div class="alert alert-danger">
									{{session('warn_two')}}
								</div>
							@endif



							<form action="{{route('view.cart')}}" method="GET" class="mb-8 mb-md-0">
								
								<label class="fs-sm ft-medium text-dark">Coupon code:</label>
								<div class="row form-row">
									<div class="col">
										
										<input name="cupon_name" class="form-control" type="text" placeholder="Enter coupon code*">
									</div>
									<div class="col-auto">
										<button class="btn btn-dark" type="submit">Apply</button>
									</div>
								</div>
							</form>

							<div class="mt-3 card mb-4 gray mfliud">
							  <div class="card-body">
								<ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Subtotal</span> <span class="ml-auto text-dark ft-medium">&#2547;{{$sub_total}}</span>
								  </li>
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Discount</span> <span class="ml-auto text-dark ft-medium">{{$discount}}</span>
								  </li>

								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
												
									<span>Total</span> <span class="ml-auto text-dark ft-medium">&#2547;
										
									</span>

								  </li>

								  <li class="list-group-item fs-sm text-center">
									Shipping cost calculated at Checkout *
								  </li>
								</ul>
							  </div>
							</div>
							
							<a class="btn btn-block btn-dark mb-3" href="checkout.html">Proceed to Checkout</a>
							
							<a class="btn-link text-dark ft-medium" href="shop.html">
							  <i class="ti-back-left mr-2"></i> Continue Shopping
							</a>
						</div>
						
					</div>
					
				</div>
			</section>
			<!-- ======================= Product Detail End ======================== -->
<script>
	@if(Session::has('success_update'))
			toastr.options =
			{
				"closeButton" : true,
				"progressBar" : true
			}
			toastr.success("{{session('success_update')}}");
	@endif
</script>
@endsection 