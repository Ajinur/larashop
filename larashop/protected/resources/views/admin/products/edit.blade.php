@extends('layouts.backend')

@section('content')

<section class="content-header">
  <h1>{!! Breadcrumbs::render('products') !!}</h1>
</section>
@include('layouts.partials.validation')

<div class="row">
<div class="col-md-12">
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab">General</a></li>
      <li><a href="#tab_2" data-toggle="tab">Data</a></li>
      <li><a href="#tab_3" data-toggle="tab">Links</a></li>
    </ul>
    {!! Form::model($data, array('route' => ['products.update', 'id' => $data->id], 'role' => 'form', 'files' => true)) !!}
    @include('admin.products.form')
    {!! Form::close() !!}
  </div>
</div>
</div>

@endsection