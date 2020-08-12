@extends('layouts.app')

@section('stylesAndScripts')

@endsection

@section('content')
    <orders :databaseorders='{!! json_encode($orders)!!}' :branchid="{{Auth::user()->branch_id}}"></orders>
@endsection
