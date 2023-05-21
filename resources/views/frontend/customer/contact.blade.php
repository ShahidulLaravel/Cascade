@extends('frontend.master')


@section('content')
<!-- ======================= Contact Page Detail ======================== -->
			<section class="middle">
				<div class="container">

					<div class="row justify-content-center">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="sec_title position-relative text-center">
								<h2 class="off_title">Contact Us</h2>
								<h3 class="ft-bold pt-3">Get In Touch</h3>

							</div>
						</div>
					</div>

					<div class="row align-items-start justify-content-between">

						<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
							<div class="card-wrap-body mb-4">
								<h4 class="ft-medium mb-3 theme-cl">Stay With Us</h4>
								<p>Narayanganj, Dhaka<br>Bangladesh</p>
								<p class="lh-1"><span class="text-dark ft-medium">Email:</span>shahidul.webdev@gmail.com</p>
							</div>

							<div class="card-wrap-body mb-3">
								<h4 class="ft-medium mb-3 theme-cl">Make a Call</h4>
								<h6 class="ft-medium mb-1">Customer Care:</h6>
								<p class="mb-2">+8801631903731</p>
								<h6 class="ft-medium mb-1">Careers:</h6>
								<p>+8801631903731</p>
							</div>
						</div>

						<div class="col-xl-7 col-lg-8 col-md-12 col-sm-12">
                                   @if (session('success'))
                                        <strong class="text-success">{{session('success')}}</strong>
                                   @endif
                                   <br>
                                   <br>
                                   {{-- get in touch form --}}
							<form action="{{route('send.message')}}" method="POST" class="row">
                                        @csrf
                                        <br>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label class="small text-dark ft-medium">Your Name *</label>
										<input type="text" class="form-control" placeholder="Your Name" name="name">
									</div>
								</div>

								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label class="small text-dark ft-medium">Your Email *</label>
										<input type="text" class="form-control" placeholder="Your Email" name="email">
									</div>
								</div>

								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label class="small text-dark ft-medium">Subject</label>
										<input type="text" class="form-control" placeholder="Type Your Subject" name="subject">
									</div>
								</div>

								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<label class="small text-dark ft-medium">Message</label>
										<textarea name="desp" class="form-control ht-80"></textarea>
									</div>
								</div>

								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div class="form-group">
										<button type="submit" class="btn btn-dark">Send Message</button>
									</div>
								</div>
							</form>
                                   {{-- form end here --}}
						</div>

					</div>
				</div>
			</section>
			<!-- ======================= Contact Page End ======================== -->


@endsection
