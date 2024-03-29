<!DOCTYPE html>
<html lang="zxx">
<head>
		<meta charset="utf-8"/>
		<meta name="author" content="Themezhub"/>
		<meta name="csrf-token" content="{{ csrf_token()}}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <title> Kumo - Fashion eCommerce </title>
        <!-- Custom CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="{{asset('Ecom/css/plugins/animation.css')}}" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="{{asset('Ecom/css/plugins/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('Ecom/css/plugins/flaticon.css')}}" rel="stylesheet">
        <link href="{{asset('Ecom/css/plugins/font-awesome.css')}}" rel="stylesheet">
        <link href="{{asset('Ecom/css/plugins/iconfont.css')}}" rel="stylesheet">
        <link href="{{asset('Ecom/css/plugins/ion.rangeSlider.min.css')}}" rel="stylesheet">
        <link href="{{asset('Ecom/css/plugins/light-box.css')}}" rel="stylesheet">
        <link href="{{asset('Ecom/css/plugins/line-icons.css')}}" rel="stylesheet">
        <link href="{{asset('Ecom/css/plugins/slick-theme.css')}}" rel="stylesheet">
        <link href="{{asset('Ecom/css/plugins/slick.css')}}" rel="stylesheet">
        <link href="{{asset('Ecom/css/plugins/snackbar.min.css')}}" rel="stylesheet">
        <link href="{{asset('Ecom/css/plugins/themify.css')}}" rel="stylesheet">
        <link href="{{asset('Ecom/css/styles.css')}}" rel="stylesheet">
          <style>
			.qty {
				width: 40px;
				height: 25px;
				text-align: center;
			}
			input.qtyplus { width:25px; height:25px;}
			input.qtyminus { width:25px; height:25px;}
			.color_id:checked~.form-option-label {
				border-color: #121212;
				color: #121212;
			}
			.size_id:checked~.form-option-label {
				border-color: #121212;
				color: #121212;
			}
		</style>
		@yield('style')
    </head>

    <body>
     <!--Start of Tawk.to Script-->
     <script type="text/javascript">
          var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
          (function(){
          var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
          s1.async=true;
          s1.src='https://embed.tawk.to/646a42e974285f0ec46cc262/1h0vhaoeu';
          s1.charset='UTF-8';
          s1.setAttribute('crossorigin','*');
          s0.parentNode.insertBefore(s1,s0);
          })();
     </script>
     <!--End of Tawk.to Script-->

		 <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
       <div class="preloader"></div>

        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">

            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
			<!-- Top Header -->
			<div class="py-2 br-bottom">
				<div class="container">
					<div class="row">

						<div class="col-xl-7 col-lg-6 col-md-6 col-sm-12 hide-ipad">
							<div class="top_second"><p class="medium text-muted m-0 p-0"><i class="lni lni-phone fs-sm"></i></i> Hotline <a href="#" class="medium text-dark">+8801631903731</a></p></div>
						</div>

						<!-- Right Menu -->
						<div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">
							<!-- Choose Language -->

								<div class="currency-selector dropdown js-dropdown float-right mr-3">

								@auth('customerlogin')
								<div class="dropdown">

								<a style="cursor:pointer" class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
									{{Auth::guard('customerlogin')->user()->name}}
								</a>

								<div class="dropdown-menu">
									<a class="dropdown-item" href="{{route('customer.profile')}}">My Porofile</a>
									<a class="dropdown-item" href="{{route('customer.logout')}}">Logout</a>
								</div>
								</div>
							</div>
								@else
								<a href="{{route('customer.register.login')}}" class="text-muted medium"><i class="lni lni-user mr-1"></i>Sign In / Register</a>
								@endauth
						</div>
					</div>
				</div>
			</div>

			<div class="headd-sty header">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12">
							<div class="headd-sty-wrap d-flex align-items-center justify-content-between py-3">
								<div class="headd-sty-left d-flex align-items-center">
									<div class="headd-sty-01">
										<a class="nav-brand py-0" href="{{route('frontEnd')}}">
											<img src="{{asset('Ecom/img/logo.png')}}" class="logo" alt="" />
										</a>
									</div>
									<div class="headd-sty-02 ml-3">
										<form class="bg-white rounded-md border-bold">
											<div class="input-group">
												<input id="search_input" type="text" class="form-control custom-height b-0" placeholder="Search for products..." value="{{@$_GET['searched']}}"/>
												<div class="input-group-append">
											<div class="input-group-text"><button id="search_btn" class="btn bg-white text-danger custom-height rounded px-3"
                                                   type="button"><i class="fas fa-search"></i></button></div>
										</div>
											</div>
										</form>
									</div>
								</div>
								<div class="headd-sty-last">
									<ul class="nav-menu nav-menu-social align-to-right align-items-center d-flex">
										<li>
											<div class="call d-flex align-items-center text-left">
												<i class="lni lni-phone fs-xl"></i>
												<span class="text-muted small ml-3">Call Us Now:<strong class="d-block text-dark fs-md">+8801631903731</strong></span>
											</div>
										</li>
										<li>
											<a href="#" onclick="openWishlist()">
												<i class="far fa-heart fs-lg"></i><span class="dn-counter bg-success">{{App\Models\Wishlist::where('customer_id', Auth::guard('customerlogin')->id())->count()}}</span>
											</a>
										</li>
										<a href="#" onclick="openCart()">
												<div class="d-flex align-items-center justify-content-between">
													<i class="fas fa-shopping-basket fs-lg"></i><span class="dn-counter theme-bg">{{App\Models\Cart::where('customer_id', Auth::guard('customerlogin')->id())->count()}}</span>
												</div>
										</a>
									</ul>
								</div>
								<div class="mobile_nav">
									<ul>
										<li>
										<a href="#" onclick="openSearch()">
											<i class="lni lni-search-alt"></i>
										</a>
									</li>
									<li>
										<a href="#" data-toggle="modal" data-target="#login">
											<i class="lni lni-user"></i>
										</a>
									</li>
									<li>
										<a href="#" onclick="openWishlist()">
											<i class="lni lni-heart"></i><span class="dn-counter">2</span>
										</a>
									</li>
									<li>
										<a href="#" onclick="openCart()">
											<i class="lni lni-shopping-basket"></i><span class="dn-counter">0</span>
										</a>
									</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

            <!-- Start Navigation -->
			<div class="headerd header-dark head-style-2">
				<div class="container">
					<nav id="navigation" class="navigation navigation-landscape">
						<div class="nav-header">
							<div class="nav-toggle"></div>
							<div class="nav-menus-wrapper">
								<ul class="nav-menu">
									<li><a href="{{route('frontEnd')}}" class="pl-0">Home</a></li>
									<li><a href="{{route('search.product')}}">Search Product</a></li>
									<li><a href="{{route('about')}}">About Us</a></li>
									<li><a href="{{route('contact')}}">Contact</a></li>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
			<!-- End Navigation -->
			<div class="clearfix"></div>

			{{-- our site main content start here --}}

            @yield('content')


			{{-- our site main content end here --}}

			<!-- ======================= Customer Features ======================== -->
			<section class="px-0 py-3 br-top">
				<div class="container">
					<div class="row">

						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="fas fa-shopping-basket"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">Free Shipping</h5>
									<span class="text-muted">Capped at $10 per order</span>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="far fa-credit-card"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">Secure Payments</h5>
									<span class="text-muted">Up to 6 months installments</span>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="fas fa-shield-alt"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">15-Days Returns</h5>
									<span class="text-muted">Shop with fully confidence</span>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
							<div class="d-flex align-items-center justify-content-start py-2">
								<div class="d_ico">
									<i class="fas fa-headphones-alt"></i>
								</div>
								<div class="d_capt">
									<h5 class="mb-0">24x7 Fully Support</h5>
									<span class="text-muted">Get friendly support</span>
								</div>
							</div>
						</div>

					</div>
				</div>
			</section>
			<!-- ======================= Customer Features ======================== -->

			<!-- ============================ Footer Start ================================== -->
			<footer class="dark-footer skin-dark-footer style-2">
				<div class="footer-middle">
					<div class="container">
						<div class="row">

							<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
								<div class="footer_widget">
									<img src="{{asset('Ecom/img/logo-light.png')}}" class="img-footer small mb-2" alt="" />

									<div class="address mt-3">
										Narayanganj, Dhaka<br>Bangladesh
									</div>
									<div class="address mt-3">
										01631903731<br>islamkhans148@gmail.com
									</div>
									<div class="address mt-3">
										<ul class="list-inline">
											<li class="list-inline-item"><a href="https://www.facebook.com/shahidulislam.khan.9279/"><i class="lni lni-facebook-filled"></i></a></li>

											<li class="list-inline-item"><a href="https://www.linkedin.com/in/shahidul-islam-shovon/"><i class="lni lni-linkedin-original"></i></a></li>
										</ul>
									</div>
								</div>
							</div>

							<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
								<div class="footer_widget">
									<h4 class="widget_title">Supports</h4>
									<ul class="footer-menu">
										<li><a href="{{route('contact')}}">Contact Us</a></li>
										<li><a href="{{route('about')}}">About Page</a></li>
										<li><a href="#">Size Guide</a></li>
										<li><a href="#">FAQ's Page</a></li>
										<li><a href="#">Privacy</a></li>
									</ul>
								</div>
							</div>

							<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
								<div class="footer_widget">
									<h4 class="widget_title">Shop</h4>
									<ul class="footer-menu">
										<li><a href="{{route('products.all')}}">Television</a></li>
										<li><a href="{{route('products.all')}}">Mobile</a></li>
										<li><a href="{{route('products.all')}}">Laptop</a></li>
										<li><a href="{{route('products.all')}}">Router</a></li>
										<li><a href="{{route('products.all')}}">Printer</a></li>
									</ul>
								</div>
							</div>

							<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
								<div class="footer_widget">
									<h4 class="widget_title">Company</h4>
									<ul class="footer-menu">
										<li><a href="{{route('about')}}">About</a></li>
										<li><a href="#">Blog</a></li>
										<li><a href="#">Affiliate</a></li>
										<li><a href="{{route('customer.register.login')}}">Login</a></li>
									</ul>
								</div>
							</div>

							<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
								<div class="footer_widget">
									<h4 class="widget_title">Subscribe</h4>
									<p>Receive updates, hot deals, discounts sent straignt in your inbox daily</p>
									<div class="foot-news-last">
										<div class="input-group">
										  <input type="text" class="form-control" placeholder="Email Address">
											<div class="input-group-append">
												<button type="button" class="input-group-text b-0 text-light"><i class="lni lni-arrow-right"></i></button>
											</div>
										</div>
									</div>
									<div class="address mt-3">
										<h5 class="fs-sm text-light">Secure Payments</h5>
										<div class="scr_payment"><img src="{{asset('Ecom/img/card.png')}}" class="img-fluid" alt="" /></div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="footer-bottom">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-lg-12 col-md-12 text-center">
								<p class="mb-0">© 2023 Kumo. Designd and Developed By <a href="https://www.linkedin.com/in/shahidul-islam-shovon/">Shahidul Islam Khan</a>.</p>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!-- ============================ Footer End ================================== -->

			<!-- Wishlist -->
			<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Wishlist">
				<div class="rightMenu-scroll">
					<div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
						<h4 class="cart_heading fs-md ft-medium mb-0">Saved Products</h4>
						<button onclick="closeWishlist()" class="close_slide"><i class="ti-close"></i></button>
					</div>
					<div class="right-ch-sideBar">
						@php
							$sub_total = 0;
						@endphp
						<div class="cart_select_items py-2">
							<!-- Single Item /   -->
							@foreach (App\Models\Wishlist::where('customer_id', Auth::guard('customerlogin')->id())->get() as $wish)
								<div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
								<div class="cart_single d-flex align-items-center">
									<div class="cart_selected_single_thumb">
										<a href="#"><img src="{{asset('uploads/products/preview')}}/{{$wish->rel_with_product->preview}}" width="60" class="img-fluid" alt="" /></a>
									</div>
									<div class="cart_single_caption pl-2">
										<h4 class="product_title fs-sm ft-medium mb-0 lh-1">{{$wish->rel_with_product->product_name}}</h4>
										<p class="mb-2"><span class="text-dark ft-medium small">{{$wish->rel_with_product->size_name}}</span>, <span class="text-dark small">{{$wish->rel_with_colors->color_name}}</span></p>
										<h4 class="fs-md ft-medium mb-0 lh-1">&#2547;{{$wish->rel_with_product->after_discount}}</h4>
									</div>
								</div>
								<div class="fls_last"><a href="{{route('wishlist.delete', $wish->id)}}" class="close_slide gray">
									<i class="ti-close"></i>
								</a></div>
							</div>
							@php
								$sub_total += $wish->rel_with_product->after_discount * $wish->quantity;
							@endphp
							@endforeach

						</div>

						<div class="cart_action px-3 py-3">
							<div class="form-group">
								<a href="{{route('product.wishlist')}}" class="btn d-block full-width btn-dark-light">View Wishlist</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Cart / header small cart -->
			<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right" style="display:none;right:0;" id="Cart">
				<div class="rightMenu-scroll">
					<div class="d-flex align-items-center justify-content-between slide-head py-3 px-3">
						<h4 class="cart_heading fs-md ft-medium mb-0">Products List</h4>
						<button onclick="closeCart()" class="close_slide"><i class="ti-close"></i></button>
					</div>

					<div class="right-ch-sideBar">
						@php
							$sub_total = 0;
						@endphp

						<div class="cart_select_items py-2">
							<!-- Single Item -->
							@foreach (App\Models\Cart::where('customer_id', Auth::guard('customerlogin')->id())->get() as $cart)
								<div class="d-flex align-items-center justify-content-between br-bottom px-3 py-3">
								<div class="cart_single d-flex align-items-center">
									<div class="cart_selected_single_thumb">
										<a href="#"><img src="{{asset('uploads/products/preview')}}/{{$cart->rel_with_product->preview}}" width="60" class="img-fluid" alt="" /></a>
									</div>
									<div class="cart_single_caption pl-2">
										<h4 class="product_title fs-sm ft-medium mb-0 lh-1">{{$cart->rel_with_product->product_name}}</h4>
										<p class="mb-2"><span class="text-dark ft-medium small">{{$cart->rel_with_product->size_name}}</span>, <span class="text-dark small">{{$cart->rel_with_product->color_name}}</span></p>
										<h4 class="fs-md ft-medium mb-0 lh-1">&#2547;{{$cart->rel_with_product->after_discount}} x {{$cart->quantity}}</h4>
									</div>
								</div>

								<div class="fls_last">
									<a href="{{route('remove.cart', $cart->id)}}" class="close_slide gray">
										<i class="ti-close"></i>
									</a>
								</div>

							</div>
								@php
								$sub_total += $cart->rel_with_product->after_discount * $cart->quantity;
								@endphp
							@endforeach
						</div>


						<div class="d-flex align-items-center justify-content-between br-top br-bottom px-3 py-3">
							<h6 class="mb-0">Subtotal</h6>
							<h3 class="mb-0 ft-medium">	&#2547;{{$sub_total}}</h3>
						</div>

						<div class="cart_action px-3 py-3">
							<div class="form-group">
								<a href={{route('view.cart')}} class="btn d-block full-width btn-dark-light">View Cart</a>
							</div>
						</div>

					</div>
				</div>
			</div>

			<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>


		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="{{asset('Ecom/js/jquery.min.js')}}"></script>
		<script src="{{asset('Ecom/js/popper.min.js')}}"></script>
		<script src="{{asset('Ecom/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('Ecom/js/ion.rangeSlider.min.js')}}"></script>
		<script src="{{asset('Ecom/js/slick.js')}}"></script>
		<script src="{{asset('Ecom/js/slider-bg.js')}}"></script>
		<script src="{{asset('Ecom/js/lightbox.js')}}"></script>
		<script src="{{asset('Ecom/js/smoothproducts.js')}}"></script>
		<script src="{{asset('Ecom/js/snackbar.min.js')}}"></script>
		<script src="{{asset('Ecom/js/jQuery.style.switcher.js')}}"></script>
		<script src="{{asset('Ecom/js/custom.js')}}"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

		 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



		@yield('javascript')

		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->

		<script>
			function openWishlist() {
				document.getElementById("Wishlist").style.display = "block";
			}
			function closeWishlist() {
				document.getElementById("Wishlist").style.display = "none";
			}
		</script>

		<script>
			function openCart() {
				document.getElementById("Cart").style.display = "block";
			}
			function closeCart() {
				document.getElementById("Cart").style.display = "none";
			}
		</script>

		<script>
			function openSearch() {
				document.getElementById("Search").style.display = "block";
			}
			function closeSearch() {
				document.getElementById("Search").style.display = "none";
			}
		</script>

          <script>
               $('#search_btn').click(function(){
                    var search_input = $('#search_input').val();
                    var min = $('.min').val();
                    var max = $('.max').val();
                    var category_id = $('input[class="category_id"]:checked').attr('value');
                    var brand = $('input[class="brand"]:checked').attr('value');
                    var color_id = $('input[class="color_id"]:checked').attr('value');
                    var size_id = $('input[class="size_id"]:checked').attr('value');
                    var sorting = $('.sorting').val();
                    var link = '{{route('search.product')}}'+'?searched='+search_input+'&min='+min+'&max='+max+'&category_id='+category_id+"&brand_id="+brand+"&color_id="+color_id+"&size_id="+size_id+"&sort="+sorting;
                    window.location.href = link;
               });

               //for submit button
               $('.range_btn').click(function(){
                    var search_input = $('#search_input').val();
                    var min = $('.min').val();
                    var max = $('.max').val();
                    var category_id = $('input[class="category_id"]:checked').attr('value');
                    var brand = $('input[class="brand"]:checked').attr('value');
                    var color_id = $('input[class="color_id"]:checked').attr('value');
                    var size_id = $('input[class="size_id"]:checked').attr('value');
                    var sorting = $('.sorting').val();
                    var link = '{{route('search.product')}}'+'?searched='+search_input+'&min='+min+'&max='+max+'&category_id='+category_id+"&brand_id="+brand+"&color_id="+color_id+"&size_id="+size_id+"&sort="+sorting;
                    window.location.href = link;
               });
               //category
               $('.category_id').click(function(){
                    var category_checked = '{{@$_GET['category_id']}}';
                    var category_new_click = $(this).attr('value');
                    if(category_checked == category_new_click){
                         var category_id = '';
                    }else{
                         var category_id = category_new_click
                    }
                    var search_input = $('#search_input').val();
                    var min = $('.min').val();
                    var max = $('.max').val();
                    var brand = $('input[class="brand"]:checked').attr('value');
                    var color_id = $('input[class="color_id"]:checked').attr('value');
                    var size_id = $('input[class="size_id"]:checked').attr('value');
                    var sorting = $('.sorting').val();
                    var link = '{{route('search.product')}}'+'?searched='+search_input+'&min='+min+'&max='+max+'&category_id='+category_id+"&brand_id="+brand+"&color_id="+color_id+"&size_id="+size_id+"&sort="+sorting;
                    window.location.href = link;
               });
               //brands
               $('.brand').click(function(){
                    var search_input = $('#search_input').val();
                    var brand_checked = '{{@$_GET['brand']}}';
                    var brand_new_click = $(this).attr('value');
                    if(brand_checked == brand_new_click){
                         var brand = '';
                    }else{
                         var brand = brand_new_click
                    }
                    var min = $('.min').val();
                    var max = $('.max').val();
                    var category_id = $('input[class="category_id"]:checked').attr('value');
                    var color_id = $('input[class="color_id"]:checked').attr('value');
                    var size_id = $('input[class="size_id"]:checked').attr('value');
                    var sorting = $('.sorting').val();
                    var link = '{{route('search.product')}}'+'?searched='+search_input+'&min='+min+'&max='+max+'&category_id='+category_id+"&brand_id="+brand+"&color_id="+color_id+"&size_id="+size_id+"&sort="+sorting;
                    window.location.href = link;
               });
               //color
               $('.color_id').click(function(){
                    var search_input = $('#search_input').val();
                    var min = $('.min').val();
                    var max = $('.max').val();
                    var category_id = $('input[class="category_id"]:checked').attr('value');
                    var brand = $('input[class="brand"]:checked').attr('value');
                    var color_id = $('input[class="color_id"]:checked').attr('value');
                    var size_id = $('input[class="size_id"]:checked').attr('value');
                    var sorting = $('.sorting').val();
                    var link = '{{route('search.product')}}'+'?searched='+search_input+'&min='+min+'&max='+max+'&category_id='+category_id+"&brand_id="+brand+"&color_id="+color_id+"&size_id="+size_id+"&sort="+sorting;
                    window.location.href = link;
               });
               //size
               $('.size_id').click(function(){
                    var search_input = $('#search_input').val();
                    var min = $('.min').val();
                    var max = $('.max').val();
                    var category_id = $('input[class="category_id"]:checked').attr('value');
                    var brand = $('input[class="brand"]:checked').attr('value');
                    var color_id = $('input[class="color_id"]:checked').attr('value');
                    var size_id = $('input[class="size_id"]:checked').attr('value');
                    var sorting = $('.sorting').val();
                    var link = '{{route('search.product')}}'+'?searched='+search_input+'&min='+min+'&max='+max+'&category_id='+category_id+"&brand_id="+brand+"&color_id="+color_id+"&size_id="+size_id+"&sort="+sorting;
                    window.location.href = link;
               });
               //sorting
               $('.sorting').change(function(){
                    var search_input = $('#search_input').val();
                    var min = $('.min').val();
                    var max = $('.max').val();
                    var category_id = $('input[class="category_id"]:checked').attr('value');
                    var brand = $('input[class="brand"]:checked').attr('value');
                    var color_id = $('input[class="color_id"]:checked').attr('value');
                    var size_id = $('input[class="size_id"]:checked').attr('value');
                    var sorting = $('.sorting').val();
                    var link = '{{route('search.product')}}'+'?searched='+search_input+'&min='+min+'&max='+max+'&category_id='+category_id+"&brand_id="+brand+"&color_id="+color_id+"&size_id="+size_id+"&sort="+sorting;
                    window.location.href = link;
               });
          </script>
</body>
</html>
