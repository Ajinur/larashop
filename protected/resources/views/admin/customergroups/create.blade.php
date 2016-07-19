@extends('layouts.backend')

@section('content')

<section class="content-header">
  <h1>{!! Breadcrumbs::render('customergroups') !!}</h1>
</section>
@include('layouts.partials.validation')

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Add Customer Group</h3>
      </div>
      {!! Form::open(array('route' => 'customergroups.store', 'role' => 'form')) !!}
          @include('admin.customergroups.form')
      {!! Form::close() !!}
    </div>  
  </div>
</div>

@endsection