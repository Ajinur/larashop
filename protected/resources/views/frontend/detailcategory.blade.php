@extends('layouts.frontend')

@section('content')

<div class="col-sm-9 padding-right">

	<div class="features_items">

		<h2 class="title text-center">{{ $title }}</h2>

			@if(!$data->isEmpty())

			{!! Form::open(array('route' => ['category.detail', 'slug' => $slug], 'method' => 'GET')) !!}

			<label class="col-md-2">Short By</label>
			<div class="col-md-3">
				{!! Form::select('shortby', $shortby, Input::get('shortby'), ['placeholder' => 'Default']) !!}
			</div>
			
			<!--label class="col-md-2">Show</label>
			<div class="col-md-3">
				{!! Form::select('show', $show, Input::get('show'), ['placeholder' => 'Show']) !!}
			</div-->
			
			<div class="col-md-2">
				{!! Form::submit('filter', ['class' => 'btn btn-default']) !!}
			</div>
			
			{!! Form::close() !!} <br/><br/><br/><br/>

			@foreach($data as $row)

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

				{!! $data->links() !!}

			</ul>
			@else
				<p>Belum ada produk di kategori ini.</p>
			@endif
	</div>

</div>



@endsection