@extends('layouts.backend')

@section('content')

<section class="content-header">
  <h1>{!! Breadcrumbs::render('customers') !!}</h1>
</section>
@include('layouts.partials.alert')
<a href="{{ route('customers.create') }}" class="btn btn-primary">Add Customer</a><br/><br/>
<div class="box">
	<div class="box-header">
	  <h3 class="box-title">Customer List</h3>
	</div>
	<div class="box-body">
	  <table id="example1" class="table table-bordered table-striped">
	    <thead>
	      <tr>
	        <th>Customer Name</th>
	        <th>Email</th>
	        <th>Customer Group</th>
	        <th>IP</th>
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
        ajax: '{!! route('customers.data') !!}',
        columns: [
            { data: 'nama', name: 'customer.nama' },
            { data: 'email', name: 'customer.email' },
            { data: 'customer_group_name', name: 'customer_group.customer_group_name' },
            { data: 'ip', name: 'customer.ip' },
            { data: 'action', name: 'action', orderable: false, searchable: false, sWidth: '15%', sClass: "center"}
        ]
    });
});
</script>

