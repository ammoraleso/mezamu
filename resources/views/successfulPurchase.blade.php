@extends('layouts.app')

@section('page_title')
    MeZamÜ | Successful Purchase
@endsection

@push('stylesAndScripts')
  <link rel="stylesheet" href="{{asset('css/successfulPurchase.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
@endpush

@section('content')

<div class="card">
    <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
      <i class="checkmark">✓</i>
    </div>
      <h1>{{__('general.OrderSuccess')}}</h1> 
      <p>{{__('general.YourOrderWillCook')}}<br/>{{__('general.YourOrderWillCookSoon')}}</p>
    </div>
@endsection
