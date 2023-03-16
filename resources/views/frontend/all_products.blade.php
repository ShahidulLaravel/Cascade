@extends('frontend.master')


@section('content')

<div class="">
    	<!-- ======================= Product List ======================== -->
			<section class="middle">
				<div class="container">
				
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center">
								<h2 class="off_title">All Products</h2>
								<h3 class="ft-bold pt-3">Our All Products</h3>
							</div>
						</div>
					</div>
					
					<div class="row align-items-center rows-products">			
						<!-- Single -->
                        @foreach ($products as $product)
                          <div class="col-xl-3 col-lg-4 col-md-6 col-6">
							<div class="product_grid card b-0">
								<div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">Sale</div>
								@if ($product->discount != null)
									<div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">New</div>
									<div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">-{{$product->discount}}%</div>
								@endif

								<div class="card-body p-0">
									<div class="shop_thumb position-relative">
										<a class="card-img-top d-block overflow-hidden" href="{{route('details',$product->id)}}" target="__blank"><img style="width:162px;height:162px;" class="card-img-top" src="{{asset('uploads/Products/preview')}}/{{$product->preview}}" alt="img here"></a>
									</div>
								</div>
                                
								<div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
									<div class="text-left">
										<div class="text-left">
								                              
                                            <div class="elso_titl"><span class="small"></span></div>
											<h5 class="fs-md mb-0 lh-1 mb-1"><a href="{{route('details', $product->id)}}">{{$product->product_name}}</a></h5>
                                            <span>Brand: {{$product->rel_to_brand->brand_name}}</span>
											<p>{{$product->rel_to_cat->category_name}}</p>
											<div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star"></i>
											</div>
											@if($product->discount != null)
												<div class="elis_rty"><span class="ft-medium text-muted line-through fs-md mr-2">&#2547;{{$product->price}}</span><span class="ft-bold theme-cl fs-lg mr-2">&#2547;{{$product->after_discount}}</span></div>
											@else
											<div class="elis_rty"><span class="ft-medium text-muted fs-md mr-2">&#2547;{{$product->price}}</span></div>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>  
                        @endforeach
												
					</div>
					
					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="position-relative text-center">
								<a href="{{route('products.all')}}" class="btn stretched-link borders">Shopping Now<i class="lni lni-arrow-right ml-2"></i></a>
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<!-- ======================= Product List ======================== -->
</div>

@endsection

