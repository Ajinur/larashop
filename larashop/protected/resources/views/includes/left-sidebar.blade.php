

<div class="left-sidebar">

	<h2>Yahoo! Live Chat</h2>

	<div align="center">

		<a href="ymsgr:sendIM?budi_zha"> 

		<img src="http://opi.yahoo.com/online?u=budi_zha&amp;m=g&amp;t=14&amp;l=us"/>

	</div><br/>



	<!--h2>Category</h2>

	<div class="panel-group category-products" id="accordian">

		@foreach ($category as $level1)

		@if(count($level1->sub_cat) > 0)

		<div class="panel panel-default">

		<div class="panel-heading">

			<h4 class="panel-title">

				<a data-toggle="collapse" data-parent="#accordian" href="#{{ $level1->category_name }}">

					<span class="badge pull-right"><i class="fa fa-plus"></i></span>

					{{ $level1->category_name }}

				</a>

			</h4>

		</div>

		

		<div id="{{ $level1->category_name }}" class="panel-collapse collapse">

			<div class="panel-body">

				<ul>

					@foreach ($level1->sub_cat as $level2)

					<li><a href="{{ 'category/' . $level2->slug }}">{{ $level2->category_name }}</a></li>

					@endforeach

				</ul>

			</div>

		</div>

		</div>

		@else

		<div class="panel panel-default">

			<div class="panel-heading">

				<h4 class="panel-title"><a href="{{ 'category/' . $level1->slug }}">{{ $level1->category_name }}</a></h4>

			</div>

		</div>

		@endif

		@endforeach

	</div-->



	<div class="brands_products">

		<h2>Brands</h2>



		<div class="brands-name">

			<ul class="nav nav-pills nav-stacked">

				@foreach($brands as $brand)

				<li><a href="{{ url('/brand/' .$brand->slug) }}"> <span class="pull-right">({{ count($brand->product) }})</span>{{ $brand->brand_name }}</a></li>

				@endforeach

			</ul>

		</div>

	</div>



	<!--div class="price-range">

		<h2>Urutkan</h2>

		<div class="well text-center">

			 {!! Form::open(array('url' => 'price/range')) !!}

			 <input type="text" name="price" class="span2" data-slider-value="[100000,1000000]" data-slider-min="100000" data-slider-max="1000000" data-slider-step="5" id="sl2" >

			 <br />

			 {!! Form::submit('Filter', ['class' => 'btn btn-primary btn-sm']) !!}

			 {!! Form::close() !!}

		</div>

	</div-->



	<div class="shipping text-center">

		{!! Html::image('assets/frontend/images/home/shipping.jpg') !!}

	</div>



	</div>



	