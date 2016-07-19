@extends('layouts.backend')

@section('content')

<section class="content-header">
  <h1>{!! Breadcrumbs::render('categories') !!}</h1>
</section>
@include('layouts.partials.alert')
<a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a><br/><br/>
<div class="box">
	<div class="box-header">
	  <h3 class="box-title">Category List</h3>
	</div>
	<div class="box-body">
	  <table id="example1" class="table table-bordered table-striped">
	    <thead>
	      <tr>
	        <th style="width: 70%;">Category Name</th>
	        <th style="text-align: right;">Sort Order</th>
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
        ajax: '{!! route('categories.data') !!}',
        columns: [
            { data: 'category_name', name: 'category_name' },
            { data: 'order', name: 'order' },
            { data: 'action', name: 'action', orderable: false, searchable: false, sWidth: '15%', sClass: "center"}
        ]
    });
});
</script>

