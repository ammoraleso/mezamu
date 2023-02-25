@extends('layouts.app')

@section('page_title')
    {{ "MeZamÜ | Admin" }}
@endsection


@push('stylesAndScripts')
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/orders.css')}}">
    <script src="{{ Vite::asset('resources/js/order.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        var updateStatusUrl = '{{route('uploadOrder')}}';
        var updateDeliveredUrl = '{{route('updateDelivered')}}';
    </script>
@endpush

@section('content')

    <audio id="myAudio">
        <source src="https://mezamublobstorage.blob.core.windows.net/sounds/alert.mp3" type="audio/mpeg">
    </audio>
    <orders :databaseorders='{!! json_encode($orders)!!}' :branchid="{{Auth::user()->branch_id}}"></orders>
@endsection
