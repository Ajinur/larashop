@extends('layouts.frontend')
@section('content')

<div class="col-sm-9 padding-right">
					{!! Form::open(array('route' => 'cart')) !!}
					{!! Form::hidden('id', $product->id) !!}
					<div class="product-details">
						<div class="col-sm-5">
							<div class="view-product">
								{!! Html::image('assets/frontend/images/products/' .$product->image, $product->name, ['width' => '266px', 'height' => '381px']) !!}
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information">
								<h2>{{ $product->name }}</h2>
								<span>
									<span>Rp. {{ number_format($product->price, 2) }}</span>
								</span><br/>
								<span>
									<label>Quantity:</label>
									<input type="text" value="1" name="qty"/>
								</span>
								<span>
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Beli
									</button>
								</span>
								<p><b>Availability:</b> In Stock</p>
								<p><b>Category:</b> {{ $product['category']->category_name }}</p>
								<p><b>Brand:</b> {{ $product['brand']->brand_name }}</p>
								<div class="fb-share-button" data-href="{{ \Request::url() }}" data-layout="button_count" data-mobile-iframe="true"></div>
							</div>
						</div>
					</div>
					{!! Form::close() !!}
					<div class="category-tab shop-details-tab">
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#description" data-toggle="tab">Description</a></li>
								<li><a href="#spesification" data-toggle="tab">Spesification</a></li>
								<li><a href="#reviews" data-toggle="tab">Reviews ({{ $cnt }})</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade in active" id="description" >
								<div class="col-sm-12">
								{!! $product->description !!}
								</div>
							</div>
							<div class="tab-pane fade" id="spesification" >
								<div class="col-sm-12">
								
								</div>
							</div>
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									@foreach($testimoni as $test)
									<?php 
									$date = explode(' ', $test->testimoni_date);
							        $jam  = $date[1];
							        $tgl  = $date[0];
									?>
									<ul>
										<li><a href="#"><i class="fa fa-user"></i>{{ $test->name }}</a></li>
										<li><a href="#"><i class="fa fa-clock-o"></i>{{ $jam }}</a></li>
										<li><a href="#"><i class="fa fa-calendar-o"></i>{{ \Carbon\Carbon::parse($tgl)->format('d-M-Y') }}</a></li>
									</ul>
									{{ $test->testimoni }} <br/><br/>
									@endforeach
									
									<p><b>Write a review</b></p>
									{!! Form::open(array('route' => 'review')) !!}
									{!! Form::hidden('product_id', $product->id) !!}
										<span>
											{!! Form::text('name', null, ['placeholder' => 'Your Name']) !!}
											{!! Form::text('email', null, ['placeholder' => 'Your Email']) !!}
										</span>
										{!! Form::textarea('testimoni', null, ['placeholder' => 'Your Review']) !!}
										<b>Rating: </b> <br/>
										Bad &nbsp;&nbsp; {!! Form::radio('rating', '1') !!} &nbsp;&nbsp;
										{!! Form::radio('rating', '2') !!} &nbsp;&nbsp;
										{!! Form::radio('rating', '3') !!} &nbsp;&nbsp;
										{!! Form::radio('rating', '4') !!} &nbsp;&nbsp;
										{!! Form::radio('rating', '5') !!} Good 
										{!! Form::submit('Continue', ['class' => 'btn btn-warning pull-right']) !!}
									{!! Form::close() !!}
								</div>
							</div>
							<!--div class="fb-comments" data-href="{{ \Request::url() }}" data-numposts="5"></div-->
						</div>
					</div>
					
					<div class="recommended_items">
						<h2 class="title text-center">Related Products</h2>
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									@foreach($terlaris as $laris)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													{!! Html::image('assets/frontend/images/products/' .$laris->image, $laris->name, ['width' => '259px', 'height' => '195px']) !!}
													<h2>Rp. {{ number_format($laris->price, 2) }}</h2>
													<p><a href="{{ url('/product/' . $laris->slug) }}">{{ $laris->name }}</a></p>
													<a href="{{ url('/product/' . $laris->slug) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Lihat Detail</a>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					
				</div>
@endsection

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=1035893046505061";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '828719273938639',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>