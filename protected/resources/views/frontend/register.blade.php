@extends('layouts.frontend')
@section('content')

<div class="container">
    <div class="row">
        @include('layouts.partials.validation')
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">Isikan Data Anda</div>
                <div class="panel-body">
                    {!! Form::open(array('route' => 'customer.store', 'role' => 'form', 'class' => 'form-horizontal')) !!}
                        {!! csrf_field() !!}
                        
                        {!! Form::hidden('invoice', $invoice) !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">Nama Lengkap</label>
                            <div class="col-md-6">
                                {!! Form::text('nama', Input::old('nama'), ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Nomor Handphone</label>
                            <div class="col-md-6">
                                {!! Form::text('telepon', Input::old('telepon'), ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Alamat Lengkap</label>
                            <div class="col-md-6">
                                {!! Form::textarea('alamat', Input::old('alamat'), ['class' => 'form-control', 'rows' => 5]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Provinsi</label>
                            <div class="col-md-6">
                                {!! Form::select('provinsi', $provinsi, Input::old('provinsi'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Kode Pos</label>
                            <div class="col-md-6">
                                {!! Form::text('kodepos', Input::old('kodepos'), ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Alamat Email</label>
                            <div class="col-md-6">
                                {!! Form::text('email', Input::old('email'), ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Simpan
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
