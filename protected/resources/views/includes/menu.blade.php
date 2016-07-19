<div class="header-bottom">

	<div class="container">

		<div class="row">

			<div class="col-sm-9">

				<div class="navbar-header">

					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

						<span class="sr-only">Toggle navigation</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

					</button>

				</div>

				<div class="mainmenu pull-left">

					<ul class="nav navbar-nav collapse navbar-collapse">

						<li><a href="{{ url('/') }}" class="active">Home</a></li>

						@foreach ($category as $level1)

						@if(count($level1->sub_cat) > 0)

						<li class="dropdown"><a href="#">{{ $level1->category_name }}<i class="fa fa-angle-down"></i></a>

                            <ul role="menu" class="sub-menu">

                                @foreach ($level1->sub_cat as $level2)

                                <li><a href="{{ url('category/' . $level2->slug) }}">{{ $level2->category_name }}</a></li>

                                @endforeach

                            </ul>

                        </li>

						@else

						<li><a href="{{ url('category/' . $level1->slug) }}">{{ $level1->category_name }}</a></li>

						@endif

						@endforeach

					</ul>

				</div>

			</div>

			<div class="col-sm-3">

				<div class="search_box pull-right">

					<input type="text" placeholder="Search"/>

				</div>

			</div>

		</div>

	</div>

</div>