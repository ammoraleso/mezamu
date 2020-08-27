@extends('layouts.app')

@push('stylesAndScripts')
    <link rel="stylesheet" href="{{asset('css/orders.css')}}">
@endpush

@section('content')
    <orders :databaseorders='{!! json_encode($orders)!!}' :branchid="{{Auth::user()->branch_id}}"></orders>
@endsection
