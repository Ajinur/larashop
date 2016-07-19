@extends('layouts.backend')

@section('content')

<section class="content-header">
  <h1>{!! Breadcrumbs::render('tags') !!}</h1>
</section>
@include('layouts.partials.alert')
<a href="{{ route('tags.create') }}" class="btn btn-primary">Add Tag</a><br/><br/>
<div class="box">
	<div class="box-header">
	  <h3 class="box-title">Tags List</h3>
	</div>
	<div class="box-body">
	  <table id="example1" class="table table-bordered table-striped">
	    <thead>
	      <tr>
	        <th style="width: 70%;">Tag Name</th>
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
        ajax: '{!! route('tags.data') !!}',
        columns: [
            { data: 'tag', name: 'tag' },
            { data: 'action', name: 'action', orderable: false, searchable: false, sWidth: '15%', sClass: "center"}
        ]
    });
});
</script>

