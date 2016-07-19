@extends('layouts.frontend')
@section('content')

<div class="col-sm-9 padding-right">
					<div class="product-details">
						<div class="col-sm-5">
							<div class="view-product">
								{!! Html::image('assets/images/home/' .$product->image) !!}
								<h3>ZOOM</h3>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information">
								<h2>{{ $product->name }}</h2>
								<p>Web ID: 1089772</p>
								<span>
									<span>Rp. {{ number_format($product->price, 2) }}</span>
									<label>Quantity:</label>
									<input type="text" value="1" />
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
								<p><b>Availability:</b> In Stock</p>
								<p><b>Category:</b> {{ $product['category']->category_name }}</p>
								<p><b>Brand:</b> {{ $product['brand']->brand_name }}</p>
								<a href="">
								{!! Html::image('assets/images/product-details/share.png', '', 
								['class' => 'share img-responsive']) !!}
								</a>
							</div>
						</div>
					</div>
					
					<div class="category-tab shop-details-tab">
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews ({{ $cnt }})</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="reviews" >
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
									
									<p><b>Isi Testimonial Anda</b></p>
									<form action="#">
										<span>
											<input type="text" placeholder="Nama"/>
											<input type="email" placeholder="Alamat Email"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> {!! Html::image('assets/images/product-details/rating.png', '') !!}
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div>
					
					<div class="recommended_items">
						<h2 class="title text-center">produk terlaris</h2>
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									@foreach($terlaris as $laris)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													{!! Html::image('assets/images/home/' .$laris->image, '') !!}
													<h2>Rp. {{ number_format($laris->price, 2) }}</h2>
													<p>{{ $laris->name }}</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div>
					
				</div>
@endsection