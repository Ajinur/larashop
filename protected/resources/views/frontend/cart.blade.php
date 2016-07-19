@extends('layouts.frontend')
@section('content')

@if(!$cart_content->isEmpty())
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Keranjang</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php $i = 1 ?>
					@foreach($cart_content as $cart)
						<tr>
							<td class="cart_product">
								<h4><a href="{{ url('product/' .$cart->slug) }}">{{ $cart->name }}</a></h4>
							</td>
							<td class="cart_price">
								<p>{{ 'Rp. ' .number_format($cart->price, 2) }}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									{{ $cart->qty }}
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{ number_format($cart->subtotal, 2) }}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{ url('cart/delete/' .$cart->rowid) }}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section>

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Total Belanja</h3>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Sub Total <span>{{ number_format(Cart::total(), 2) }}</span></li>
							<li>Ongkos Kirim <span>Free</span></li>
							<li>Total <span>{{ number_format(Cart::total(), 2) }}</span></li>
						</ul>
							<a class="btn btn-default check_out" href="{{ route('checkout') }}">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section>
@else
	<section id="do_action">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Keranjang</li>
				</ol>
			</div>	
			<div class="heading">
				<h3>Daftar belanja Anda masih kosong.</h3>
			</div>
		</div>
	</section>
@endif
@endsection