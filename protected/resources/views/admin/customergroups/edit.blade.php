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
        <h3 class="box-title">Edit Customer Group</h3>
      </div>
      {!! Form::model($data, array('route' => ['customergroups.update', 'id' => $data->id], 'role' => 'form')) !!}
      @include('admin.customergroups.form')
      {!! Form::close() !!}
    </div>  
  </div>
</div>

@endsection