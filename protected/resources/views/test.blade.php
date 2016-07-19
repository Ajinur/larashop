@extends('layouts.backend')

@section('content')


{!! $dataTable->table() !!}

@endsection

@push('scripts')
{!! Html::script('assets/backend/plugins/jQuery/jQuery-2.1.4.min.js') !!}
{!! Html::script('assets/backend/plugins/datatables/jquery.dataTables.min.js') !!}
{!! Html::script('assets/backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endpush