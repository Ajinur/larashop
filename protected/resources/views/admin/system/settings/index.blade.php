@extends('layouts.backend')

@section('content')

<section class="content-header">
  <h1>{!! Breadcrumbs::render('system.settings') !!}</h1>
</section>
@include('layouts.partials.validation')
@include('layouts.partials.alert')
<div class="row">
<div class="col-md-12">
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab">General</a></li>
      <li><a href="#tab_2" data-toggle="tab">Store</a></li>
    </ul>
    {!! Form::model($data, array('route' => ['system.settings.update', 'id' => 1], 'role' => 'form', 'files' => true)) !!}
    @include('admin.system.settings.form')
    {!! Form::close() !!}
  </div>
</div>
</div>

@endsection