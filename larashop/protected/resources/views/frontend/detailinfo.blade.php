@extends('layouts.frontend')

@section('content')

<div class="col-sm-9">
	<div class="blog-post-area">
		<h2 class="title text-center">Informations</h2>
		<div class="single-blog-post">
			<h3>{{ $info->title }}</h3>
			{!! $info->description !!}
		</div>
	</div>
</div>

@endsection