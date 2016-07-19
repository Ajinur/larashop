@extends('layouts.backend')

@section('content')

<section class="content-header">
  <h1>{!! Breadcrumbs::render('information') !!}</h1>
</section>
@include('layouts.partials.validation')

<div class="row">
<div class="col-md-12">
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab">General</a></li>
      <li><a href="#tab_2" data-toggle="tab">Data</a></li>
    </ul>
    {!! Form::model($data, array('route' => ['information.update', 'id' => $data->id], 'role' => 'form')) !!}
    @include('admin.information.form')
    {!! Form::close() !!}
  </div>
</div>
</div>

@endsection