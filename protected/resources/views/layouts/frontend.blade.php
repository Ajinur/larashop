<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="">

    <meta name="author" content="">

    <title>Larashop</title>

    {!! Html::style('assets/frontend/css/bootstrap.min.css') !!}

    {!! Html::style('assets/frontend/css/font-awesome.min.css') !!}

    {!! Html::style('assets/frontend/css/prettyPhoto.css') !!}

    {!! Html::style('assets/frontend/css/price-range.css') !!}

    {!! Html::style('assets/frontend/css/animate.css') !!}

    {!! Html::style('assets/frontend/css/main.css') !!}

    {!! Html::style('assets/frontend/css/responsive.css') !!}



    <link rel="shortcut icon" href="images/ico/favicon.ico">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/frontend/images/ico/apple-touch-icon-144-precomposed.png">

    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/frontend/images/ico/apple-touch-icon-114-precomposed.png">

    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/frontend/images/ico/apple-touch-icon-72-precomposed.png">

    <link rel="apple-touch-icon-precomposed" href="/assets/frontend/images/ico/apple-touch-icon-57-precomposed.png">

</head>



<body>

	<header id="header">

		<div class="header-middle">

			<div class="container">

				<div class="row">

					<div class="col-sm-2">

						<div class="logo pull-left">

							<a href="{{ url('/') }}">{!! Html::image('assets/frontend/images/home/logo.png') !!} </a>

						</div>

					</div>

					<div class="col-sm-10">

						<div class="shop-menu pull-right">

							<ul class="nav navbar-nav">

								<li><a href="{{ url('cart') }}"><i class="fa fa-shopping-cart"></i> Cart</a></li>

							</ul>

						</div>

					</div>

				</div>

			</div>

		</div>

		@include('includes.menu')

	</header>

	

	@if(\Request::segment(1) != '')

	@else

	@include('includes.slider')

	@endif

	

	

	<section>

		<div class="container">

			<div class="row">

				@include('layouts.partials.alert')
				@include('layouts.partials.validation')
				<div class="col-sm-3">

					@if(\Request::segment(1) == 'register')

					@elseif(\Request::segment(1) == 'login')

					@elseif(\Request::segment(1) == 'password')

					@elseif(\Request::segment(1) == 'cart')

					@elseif(\Request::segment(1) == 'invoice')

					@else

					@include('includes.left-sidebar')

					@endif

				</div>

				@yield('content')

			</div>

		</div>

	</section>

	

	@include('includes.footer')

	

    {!! Html::script('assets/frontend/js/jquery.js') !!}

    {!! Html::script('assets/frontend/js/bootstrap.min.js') !!}

    {!! Html::script('assets/frontend/js/jquery.scrollUp.min.js') !!}

    {!! Html::script('assets/frontend/js/price-range.js') !!}

    {!! Html::script('assets/frontend/js/jquery.prettyPhoto.js') !!}

    {!! Html::script('assets/frontend/js/main.js') !!}

    <!--Start of Zopim Live Chat Script-->
    
	<script type="text/javascript">
	window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
	d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
	_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
	$.src="//v2.zopim.com/?3uV8lv1ZuodpKPXKGHoA72x72smCA0Pb";z.t=+new Date;$.
	type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
	</script>
<!--End of Zopim Live Chat Script-->

</body>

</html>