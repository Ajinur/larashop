@extends('layouts.frontend')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div style="text-align: center;">
                <i class="fa fa-seacrh-plus pull-left icon"></i>
                <h2> Invoice : {{ $trans->invoice }}</h2>
                <h3> Tanggal : {{ \Carbon\Carbon::parse($trans->tanggal)->format('d-M-Y') }}</h3>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <strong>Nama : {{ $customer->nama }}</strong><br/>
                        <strong>Alamat : {{ $customer->alamat }}</strong><br/>
                        <strong>Provinsi : {{ $provinsi }}</strong><br/>
                        <strong>Kode Pos : {{ $customer->kodepos }}</strong><br/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 style="text-align: center;"><strong>Order Summary</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td><strong>Item Name</strong></td>
                                        <td><strong>Item Price</strong></td>
                                        <td><strong>Item Quantity</strong></td>
                                        <td><strong>Total Price</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transaction as $list)
                                    <tr>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ number_format($list->price, 2) }}</td>
                                        <td>{{ $list->qty }}</td>
                                        <td>{{ number_format($list->subtotal, 2) }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3"><strong>Sub Total</strong></td>
                                        <td><strong>{{ number_format($list->subtotal, 2) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <p style="text-align: center;">
                    <a href="{{ url('/') }}" class="btn btn-info">Selesai</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
