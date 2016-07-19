@extends('layouts.backend')

@section('content')

<section class="content-header">
  <h1>{!! Breadcrumbs::render('information') !!}</h1>
</section>
<a href="{{ route('information.create') }}" class="btn btn-primary">Add Information</a><br/><br/>
@include('layouts.partials.alert')
<div class="box">
	<div class="box-header">
	  <h3 class="box-title">Informations</h3>
	</div>
	<div class="box-body">
	  <table id="example1" class="table table-bordered table-striped">
	    <thead>
	      <tr>
	        <th>Title</th>
	        <th>Sort Order</th>
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
        ajax: '{!! route('information.data') !!}',
        columns: [
            { data: 'title', name: 'title', sWidth: '70%' },
            { data: 'order', name: 'order' },
            { data: 'action', name: 'action', orderable: false, searchable: false, sWidth: '15%', sClass: "center"}
        ]
    });
});
</script>

