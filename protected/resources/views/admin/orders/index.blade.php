@extends('layouts.backend')

@section('content')

<section class="content-header">
  <h1>{!! Breadcrumbs::render('orders') !!}</h1>
</section>
@include('layouts.partials.alert')
<div class="box">
	<div class="box-header">
	  <h3 class="box-title">Order List</h3>
	</div>
	<div class="box-body">
	  <table id="example1" class="table table-bordered table-striped">
	    <thead>
	      <tr>
	        <th>Customer</th>
	        <th>Status</th>
	        <th>Total</th>
	        <th>Order Date</th>
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
        ajax: '{!! route('orders.data') !!}',
        columns: [
            { data: 'customer', name: 'customer' },
            { data: 'status', name: 'status' },
            { data: 'subtotal', name: 'transactions.subtotal' },
            { data: 'tanggal', name: 'transactions.tanggal' },
            { data: 'action', name: 'action', orderable: false, searchable: false, sWidth: '20%', sClass: "center"}
        ]
    });
});
</script>

