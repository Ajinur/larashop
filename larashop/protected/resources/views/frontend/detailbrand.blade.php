@extends('layouts.frontend')

@section('content')

<div class="col-sm-9 padding-right">

	<div class="features_items">

		<h2 class="title text-center">{{ $title }}</h2>

			@if(!$product->isEmpty())
			@foreach($product as $row)

			<div class="col-sm-4">

			<div class="product-image-wrapper">

				<div class="single-products">

					<div class="productinfo text-center">

						{!! Html::image('assets/frontend/images/products/' . $row->image, '', ['width' => '259px', 'height' => '195px']) !!}

						<h2>{{ 'Rp ' . number_format($row->price, 2) }}</h2>

						<p><a href="{{ url('/product/' . $row->slug) }}">{{ $row->name }}</a></p>

						<a href="{{ url('/product/' . $row->slug) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Lihat Detail</a>

					</div>

				</div>

			</div>

			</div>

			@endforeach

			<ul class="pagination">

				{!! $product->links() !!}

			</ul>
			@else
				<p>Belum ada produk di merek ini.</p>
			@endif
	</div>

</div>



@endsection