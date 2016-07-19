@extends('layouts.frontend')

@section('content')

<div class="col-sm-9 padding-right">

	<div class="features_items">

		<h2 class="title text-center"></h2>

			@foreach($product as $feature)

			<div class="col-sm-4">

			<div class="product-image-wrapper">

				<div class="single-products">

					<div class="productinfo text-center">

						{!! Html::image('assets/frontend/images/products/' . $feature->image, $feature->name, ['width' => '259px', 'height' => '195px']) !!}

						<h2>{{ 'Rp ' . number_format($feature->price, 2) }}</h2>

						<p><a href="{{ url('/product/' . $feature->slug) }}">{{ $feature->name }}</a></p>

						<a href="{{ url('/product/' . $feature->slug) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Lihat Detail</a>

					</div>

				</div>

			</div>

			</div>

			@endforeach

			<ul class="pagination">

				{!! $product->links() !!}

			</ul>

	</div>

</div>



@endsection