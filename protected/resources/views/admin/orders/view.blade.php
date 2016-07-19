@extends('layouts.backend')

@section('content')

<section class="content-header">
  <h1>{!! Breadcrumbs::render('orders') !!}</h1>
</section>
@include('layouts.partials.alert')

{!! Form::open(['class' => 'form-horizontal']) !!}
<div class="form-group">
  <label class="col-sm-2 control-label">Invoice No.</label>
  <div class="col-sm-10"><p class="form-control-static">{{ $orderInfo->formid }}</p></div>
</div>
<div class="form-group">
  <label class="col-sm-2 control-label">Customer</label>
  <div class="col-sm-10"><p class="form-control-static">{{ $orderInfo->customer }}</p></div>
</div>
<div class="form-group">
  <label class="col-sm-2 control-label">Customer Type</label>
  <div class="col-sm-10"><p class="form-control-static">{{ $orderInfo->type }}</p></div>
</div>
{!! Form::close() !!}

<div class="box">
	<div class="box-header">
	  <h3 class="box-title">Orders List</h3>
	</div>
	<div class="box-body">
	  <table id="example1" class="table table-bordered table-striped">
	    <thead>
	      <tr>
	        <th>No.</th>
	        <th>Product Name</th>
	        <th>Quantity</th>
	        <th>Subtotal</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php $i = 1 ?>
	    	@foreach($orders as $order)
	    		<tr>
	    			<td>{{ $i++ }}</td>
	    			<td>{{ $order->products }}</td>
	    			<td>{{ $order->qty }}</td>
	    			<td>{{ number_format($order->subtotal, 2)  }}</td>
	    		</tr>
	    	@endforeach
	    </tbody>
	  </table>
	</div>
</div>

@endsection

{!! Html::script('assets/backend/plugins/jQuery/jQuery-2.1.4.min.js') !!}

<script>
$(function() {
    $('#example1').DataTable({
        processing: true,
        serverSide: false,
    });
});
</script>

