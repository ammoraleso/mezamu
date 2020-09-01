@extends('layouts.app')

@push('stylesAndScripts')
    <link rel="stylesheet" href="{{asset('css/orders.css')}}">
    <script src="{{asset('js/order.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        var updateStatusUrl = '{{route('uploadOrder')}}';
    </script>
@endpush

@section('content')
    <orders :databaseorders='{!! json_encode($orders)!!}' :branchid="{{Auth::user()->branch_id}}"></orders>
@endsection
