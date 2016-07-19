@extends('layouts.backend')

@section('content')

<section class="content-header">
  <h1>{!! Breadcrumbs::render('review') !!}</h1>
</section>
@include('layouts.partials.alert')
<div class="box">
	<div class="box-header">
	  <h3 class="box-title">Reviews</h3>
	</div>
	<div class="box-body">
	  <table id="example1" class="table table-bordered table-striped">
	    <thead>
	      <tr>
	        <th>Product</th>
	        <th>Author</th>
	        <th>Rating</th>
	        <th>Status</th>
	        <th>Date Added</th>
	        <th>&nbsp;</th>
	      </tr>
	    </thead>
	  </table>
	</div>
</div>

@endsection

{!! Html::script('assets/backend/plugins/jQuery/jQuery-2.1.4.min.js') !!}

<script>
$(function() {
    $('#example1').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('review.data') !!}',
        columns: [
            { data: 'name', name: 'products.name' },
            { data: 'author', name: 'author' },
            { data: 'rating', name: 'testimoni.rating' },
            { data: 'status', name: 'testimoni.status' },
            { data: 'testimoni_date', name: 'testimoni.testimoni_date' },
            { data: 'action', name: 'action', orderable: false, searchable: false, sWidth: '15%', sClass: "center"}
        ]
    });
});
</script>

