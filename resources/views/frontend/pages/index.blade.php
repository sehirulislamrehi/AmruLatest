@extends('frontend.template.layout')

@section('body-content')

<!-- banner section start -->
<section class="banner" >
	<div class="container-fluid">
		<div class="row banner-row">
			
			<!-- carousel start -->
			<div class="banner-carousel owl-carousel owl-theme">
   		 		
				<!-- banner item start -->
				@foreach(App\Models\Backend\Slider::orderBy('id','asc')->get() as $slider) 
   		 		<div class="item banner-image" style="background-image: url({{asset('images/slider/'.$slider->image)}})">
				</div>
				@endforeach
   		 		<!-- banner item end -->

   		 	</div>
			<!-- carousel end -->

		</div>
	</div>
</section>
<!-- banner section end -->

<!-- product section start -->
@foreach(App\Models\Frontend\homeBannerImg::orderBy('id','asc')->get() as $adImage) 
<section class="home-product section-padding">
	<div class="container-fluid">
		
		<!-- row start -->
		<div class="row">
			
			<!-- left part start -->
			<div class="col-md-3">
				<div class="home-product-left-image">
					<img src="{{ asset('images/addImages/'.$adImage->left_image) }}" class="img-fluid">
				</div>

				<!-- support 24/7 start -->
				<div class="home-product-left">
					<div class="home-product-left-info">
						<div class="row">
							<div class="col-md-2">
								<img src="{{ asset('frontend/images/247.png') }}" class="img-fluid">
							</div>

							<div class="col-md-10">
								<h2>Support 24/7</h2>
								<p>Contact us 24 hours a day, 7 days a week</p>
							</div>
						</div>
					</div>
				</div>
				<!-- support 24/7 end -->

				<!-- fast shipping start -->
				<div class="home-product-left fast-shipping">
					<div class="home-product-left-info">
						<div class="row">
							<div class="col-md-2">
								<img src="{{ asset('frontend/images/shipping.png') }}" class="img-fluid">
							</div>

							<div class="col-md-10">
								<h2>Fast shipping</h2>
								<p>We will deliver your goods to  anywhere in the world</p>
							</div>
						</div>
					</div>
				</div>
				<!-- fast shipping end -->

				<!-- refund start -->
				<div class="home-product-left">
					<div class="home-product-left-info">
						<div class="row">
							<div class="col-md-2">
								<img src="{{ asset('frontend/images/refund.png') }}" class="img-fluid">
							</div>

							<div class="col-md-10">
								<h2>Refund Guarantee</h2>
								<p>We will refund your money if the goods are of poor quality</p>
							</div>
						</div>
					</div>
				</div>
				<!-- refund end -->

			</div>
			<!-- left part end -->

			<!-- middle part start -->
			<div class="col-md-8">

				<!-- filtering item row start -->
				<div class="row home-product-filtering">
					<div class="col-md-12">
						<ul>
							<span class="select-filter active-filter f1" id="f1">
								<li class="filter-category  one" id="one">featured</li>
							</span>
							
						</ul>
					</div>
				</div>
				<!-- filtering item row end -->



				<!-- filter wise product show start new arrivals-->
				<div class="row filter-product-list  one">
					
					<!-- product item start -->
					@foreach(App\Models\Backend\Product::orderBy('id','desc')->where('is_featured', 1)->where('status', 1)->take(8)->get() as $product) 
					<div class="col-md-3 col-6 product-hover">
						<div class="product-item-01">
							<div class="product-hover-item">
								
								
							<a class="show-product-popup" id="{{ $product->id }}">
									<i class="fas fa-eye"></i>
								</a>
							</div>

							<!-- main thumbnail -->
							<a href="{{route('productDetails',$product->slug)}}">
								<img src="{{ asset('images/product/'.$product->images[0]->image) }}" class="img-fluid">
							</a>
							<!-- main thumbnail -->

							<!-- go product details -->
							<div class="product-name">
								<p>{{$product->name}} - {{ $product->size }}</p>
								@if($product->offer_price==NULL)
								<span>{{$product->regular_price}}TK </span>
								@else
								<span>{{$product->offer_price}}TK </span>
								<span> <del> {{$product->regular_price}}TK </del></span>
								@endif
							</div>
							
							<!-- go product details -->
							
							<div class="product-item-cart">
								@if( $product->quantity > 0 )
									<button data-id="{{ $product->id }}" data-image="{{ $product->images[0]->image }}" data-name="{{ $product->name }}" 
										@if( $product->offer_price == NULL )
										data-price="{{ $product->regular_price }}"
										@else
										data-price="{{ $product->offer_price }}"
										@endif 
										class="addToCart">
											<img src="{{ asset('frontend/images/cart-bag.png') }}"> add to bag
									</button>
								@else
								<button class="addToCart disabled">
									out of stock
								</button>
								@endif
							</div>
						</div>
					</div>
					<!-- product quick view popup start -->
					<div class="product-quick-view {{ $product->id }}">
						<i class="fas fa-times hide-quick-view"></i>
						<div class="container">
							<div class="row">
								<div class="col-md-12 product-quick-view-main-box" >
									
									<div class="row">
										<!-- left part start -->
										<div class="col-md-6">
											<div class="product-main-img">
												<a href="product-details.php">
													<img src="{{ asset('images/product/'.$product->images[0]->image) }}" class="img-fluid to-img1 ">
												</a>
											</div>
										</div>
										<!-- left part end -->

										<!-- right part start -->
										<div class="col-md-6">
											<div class="product-quick-view-right">
											<h2 class="quick-view-heading">{{ $product->name }} - {{ $product->size }}</h2>

												<!-- avaiablity and stock start -->
												<div class="row available">
													<div class="col-md-6 col-6">
														<h2>availablity : </h2>
													</div>
													<div class="col-md-6 col-6">
														@if( $product->quantity > 0 )
														<h2>in stock</h2>
														@else
														<h2 class="badge badge-danger">out of stock</h2>
														@endif
													</div>
												</div>
												<!-- avaiablity and stock end -->

												<!-- price row start -->
												<div class="row">
													<div class="col-md-12 quick-view-heading">
														@if($product->offer_price==NULL)
															<span>{{$product->regular_price}}TK </span>
															@else
															<span>{{$product->offer_price}}TK </span>
															<span> <del> {{$product->regular_price}}TK </del></span>
															@endif
														
													</div>
												</div>
												<!-- price row end -->

												<!-- description row start -->
												<div class="row">
													<div class="col-md-12">
														<h2 >description</h2>
													</div>
													<div class="col-md-12">
														<p>{{$product->description}}</p>
													</div>
												</div>
												<!-- description row end -->

											</div>
										</div>
										<!-- right part end -->

									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- product quick view popup  end -->
					@endforeach
					<!-- product item end -->
					
					

				</div>
				<!-- filter wise product show end new arrivals-->




				<!-- filter wise product show end new best seller-->

			</div>
			<!-- middle part end -->

			<!-- right part start -->
			<div class="col-md-1">
				<div class="home-product-right-image">
					<img src="{{ asset('images/addImages/'.$adImage->right_image) }}" class="img-fluid">
				</div>
			</div>
			<!-- right part end -->

		</div>
		<!-- row END -->

	</div>
</section>
<!-- product section end -->


<!-- feature banner start -->

<section class="feature-banner" style="background-image: url( {{ asset('images/addImages/'.$adImage->bottom_image) }} ); " >
	<div class="container">
		<div class="row">
			<div class="col-md-12"></div>
		</div>
	</div>
</section>

@endforeach
<!-- feature banner end -->


<!-- feature product start  -->

@foreach(App\Models\Backend\Category::orderBy('id','desc')->where('is_delete', 0)->where('parent_id', '!=',0)->get() as $category) 
@if( count( App\Models\Backend\Product::orderBy('id','desc')->where('status', 1)->where('cat_id', $category->id )->get() ) > 0 )
<section class="featre-product section-padding">
	<div class="container">

		<!-- category name here start -->
		<div class="row">
			<div class="col-md-12">
				<h2>{{$category->name}}</h2>
			</div>
		</div>
		<!-- category name here end -->

		<div class="row">
			
			<!-- product item start -->
			@foreach(App\Models\Backend\Product::orderBy('id','desc')->where('status', 1)->where('cat_id', $category->id)->take(8)->get() as $product) 
			<div class="col-md-3 col-6 product-hover">
				<div class="product-item-01">
					<div class="product-hover-item">
						
						
						<a class="show-product-popup" id="{{$product->id}}">
							<i class="fas fa-eye"></i>
						</a>
					</div>

					<!-- main thumbnail -->
					<a href="{{route('productDetails',$product->slug)}}">
						<img src="{{ asset('images/product/'.$product->images[0]->image) }}" class="img-fluid">
					</a>
					<!-- main thumbnail -->

					<!-- go product details -->
					<div class="product-name">
						<p>{{$product->name}} {{ $product->size }}</p>
						@if($product->offer_price==NULL)
						<span>{{$product->regular_price}}TK </span>
						@else
						<span>{{$product->offer_price}}TK </span>
						<span> <del> {{$product->regular_price}}TK </del></span>
						@endif
					</div>
					
					<!-- go product details -->
					
					<div class="product-item-cart">
						@if( $product->quantity > 0 )
						<button data-id="{{ $product->id }}" data-image="{{ $product->images[0]->image }}" data-name="{{ $product->name }}" 
							@if( $product->offer_price == NULL )
							data-price="{{ $product->regular_price }}"
							@else
							data-price="{{ $product->offer_price }}"
							@endif 
							class="addToCart">
								<img src="{{ asset('frontend/images/cart-bag.png') }}"> add to bag
						</button>
						@else
						<button class="addToCart disabled">
							<img src="{{ asset('frontend/images/cart-bag.png') }}"> out of stock
						</button>
						@endif
					</div>
				</div>
			</div>
			
			<!-- product item end -->

			<!-- product quick view popup start -->
			<div class="product-quick-view {{$product->id}}">
				<i class="fas fa-times hide-quick-view"></i>
				<div class="container">
					<div class="row">
						<div class="col-md-12 product-quick-view-main-box" >
							
							<div class="row">
								<!-- left part start -->
								<div class="col-md-6">
									<div class="product-main-img">
										<a href="product-details.php">
											<img src="{{ asset('images/product/'.$product->images[0]->image) }}" class="img-fluid to-img1 ">
										
										</a>
									</div>

							
								</div>
								<!-- left part end -->

								<!-- right part start -->
								<div class="col-md-6">
									<div class="product-quick-view-right">
										<h2 class="quick-view-heading">{{$product->name}} {{ $product->size }}</h2>

										<!-- avaiablity and stock start -->
										<div class="row available">
											<div class="col-md-6 col-6">
												<h2>availablity : </h2>
											</div>
											<div class="col-md-6 col-6">
												@if( $product->quantity > 0 )
												<h2>in stock</h2>
												@else
												<h2 class="badge badge-danger">out of stock</h2>
												@endif
											</div>
										</div>
										<!-- avaiablity and stock end -->

										<!-- price row start -->
										<div class="row">
											<div class="col-md-12">
												<h2 class="quick-view-heading">	@if($product->offer_price==NULL)
													<span>{{$product->regular_price}}TK </span>
													@else
													<span>{{$product->offer_price}}TK </span>
													<span> <del> {{$product->regular_price}}TK </del></span>
													@endif
												</h2>
											</div>
										</div>
										<!-- price row end -->

										<!-- description row start -->
										<div class="row">
											<div class="col-md-12">
												<h2 >description</h2>
											</div>
											<div class="col-md-12">
												<p>{{$product->description}}</p>
											</div>
										</div>
										<!-- description row end -->

									</div>
								</div>
								<!-- right part end -->

							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
			<!-- product quick view popup  end -->

		</div>
	</div>
</section>
@endif
@endforeach
<!-- feature product end  -->








<!-- sign up section start -->
<section class="signup-newsletter">
	<div class="container">
		<div class="row">
			
			<!--left part start -->
			<div class="col-md-6">
				<h2>Sign up for Newsletter</h2>
			</div>
			<!--left part end-->

			<!--right part start -->
			<div class="col-md-6">
				<form id="createAd" method="POST" class="signup-news-form">
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Enter your e-mail address" name="email">
					</div>
					<div class="form-group">
						<button type="submit" class="signup-newsletter-button">
							<img src="{{ asset('frontend/images/signup_newsletter.png') }}" class="img-fluid">
						</button>
					</div>
				</form>
			</div>
			<!--right part end-->

		</div>
	</div>
</section>
<!-- sign up section end -->
@endsection



@section('cart')
<script src="{{asset('frontend/js/cart.js')}}"></script>
@endsection