@extends('layouts.backend')

@section('content')

<section class="content-header">
  <h1>{!! Breadcrumbs::render('products') !!}</h1>
</section>
@include('layouts.partials.alert')
<a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a><br/><br/>
<div class="box">
	<div class="box-header">
	  <h3 class="box-title">Product List</h3>
	</div>
	<div class="box-body">
	  <table id="example1" class="table table-bordered table-striped">
	    <thead>
	      <tr>
	        <th>Image</th>
	        <th>Product Name</th>
	        <th>Model</th>
	        <th>Price</th>
	        <th>Quantity</th>
	        <th>Status</th>
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
        ajax: '{!! route('products.data') !!}',
        columns: [
            { data: 'image', name: 'image' },
            { data: 'name', name: 'name' },
            { data: 'model', name: 'model' },
            { data: 'price', name: 'price' },
            { data: 'quantity', name: 'quantity' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false, sWidth: '15%', sClass: "center"}
        ]
    });
});
</script>

