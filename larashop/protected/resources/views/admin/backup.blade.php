@extends('layouts.backend')

@section('content')

<section class="content-header">
  <h1>{!! Breadcrumbs::render('backup') !!}</h1>
</section>
@include('layouts.partials.alert')
<a href="{{ route('backup.create') }}" class="btn btn-primary">Backup</a><br/><br/>

@endsection

{!! Html::script('assets/backend/plugins/jQuery/jQuery-2.1.4.min.js') !!}



