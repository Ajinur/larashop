<footer id="footer">

		<div class="footer-widget">

			<div class="container">

				<div class="row">

					<div class="col-sm-6">

						<div class="single-widget">

							<h2>Informasi</h2>

							<ul class="nav nav-pills nav-stacked">

								@foreach($information as $info)
								<li><a href="{{ url('information/' . $info->slug) }}">{{ $info->title }}</a></li>
								@endforeach

							</ul>

						</div>

					</div>

					<div class="col-sm-5 col-sm-offset-1">

						<div class="single-widget">

							<h2>Berlangganan</h2>

							<form action="#" class="searchform">

								<input type="text" placeholder="Email anda" />

								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>

								<p>Dapatkan informasi terbaru dari kami.</p>

							</form>

						</div>

					</div>

					

				</div>

			</div>

		</div>

		

		<div class="footer-bottom">

			<div class="container">

				<div class="row">

					<p class="pull-left"> © {{ date('Y') }} Larashop</p>

					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>

				</div>

			</div>

		</div>

		

	</footer>