@extends('layouts.app')

@section('stylesAndScripts')

@endsection

@section('content')
    <orders :branchid="{{Auth::user()->branch_id}}"></orders>
@endsection
