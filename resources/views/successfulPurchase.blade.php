@extends('layouts.app')

@section('page_title')
    MeZamÜ | Successful Purchase
@endsection

@push('stylesAndScripts')
  <link rel="stylesheet" href="{{ Vite::asset('resources/css/successfulPurchase.css')}}">
  <script src="{{ Vite::asset('resources/js/checkout.js')}}" type="text/javascript"></script>
  <link rel="stylesheet" href="{{ Vite::asset('resources/css/cart.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

@endpush

@section('content')

<div class="card">

    @include('modalDetailsFinalOrder')

    <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
      <i class="checkmark">✓</i>
    </div>
      <h1>{{__('general.OrderSuccess')}}</h1>
      <p>{{__('general.YourOrderWillCook')}}<br/>{{__('general.YourOrderWillCookSoon')}}</p>
    </div>
    <div id="back" class="pt-3"style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
      <button onclick="showModalFinalOrder();" class="btn btn-success">Ver Orden</button>
      @if (Session::get('urlMenu'))
        <a class="btn btn-danger" href={{Session::get('urlMenu')}}>Finalizar</a>
      @else
        <a class="btn btn-danger" href="{{url()->previous()}}">Finalizar</a>
      @endif
    </div>


@endsection
