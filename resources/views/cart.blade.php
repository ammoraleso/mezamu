@extends('layouts.app')

@section('title') {{ __('general.My_Cart')}} @endsection

@push('stylesAndScripts')
    <link rel="stylesheet" href="{{asset('css/input_number_spinner.css')}}">
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
    <link rel="stylesheet" href="{{asset('css/menu.css')}}">
    <script src="{{asset('js/input_number_spinner.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/cart.js')}}" type="text/javascript"></script>
    <!--Script for change and remove items from the cart-->
    <script>
        var changeQuantityUrl = '{{route('changeQuantity')}}';
        var removeItemUrl = '{{route('removeItem')}}';
    </script>
@endpush

@section('content')

    <div class="container-fluid">

        <span id="cartContainer">
            @if(Session::get('cart') && \Illuminate\Support\Arr::get(Session::get('cart'),'totalQuantity') > 0)
                <div class="grid">
                    <div class="w-100 mt-3 mr-md-5">
                        @foreach(Session::get('cart') as $cartItem)
                            @if(data_get($cartItem, 'item'))
                                @php
                                    $item = data_get($cartItem, 'item');
                                @endphp
                            <span id="cartItem{{$item['id']}}">
                                <div class="d-flex mb-3">
                                    <img alt="{{$item->name}}"  class="product-img" src="/images/{{$item->photo}}">
                                    <div class="d-flex flex-column flex-md-row justify-content-between w-100 flex-wrap position-relative">
                                        <p><strong>{{$item['name']}}</strong></p>
                                        <div class="quantity">
                                            <input onchange="changeQuantity({{$item}}, this.value);" id="quantity" name="quantity" type="number" min="1" max="100" step="1" value="{{data_get($cartItem, 'quantity')}}" class="bg-transparent" readonly="true"><!--we use readonly instead of disable because with the last one the data is not send in the request-->
                                        </div>
                                        <p class="mt-2 mt-md-0 mb-0">$ {{$item['formatedPrice']}} c/u</p>

                                        <div class="d-md-none">
                                            <a onclick="removeItem({{$item}});" href="#" style="color: currentColor"><u>{{__('general.Delete')}}</u></a>
                                        </div>
                                        <div class="d-none d-sm-block position-absolute mt-3">
                                            <a onclick="removeItem({{$item}});" href="#" style="color: currentColor"><u>{{__('general.Delete')}}</u></a>
                                        </div>
                                    </div>
                                </div>
                            </span>
                            @endif
                        @endforeach
                    </div>

                    <hr>
                    <div class="w-md-40 px-md-3 pt-md-3 mt-4 mt-md-0 card-md rounded-20px" style="height: fit-content">
                        <h3><strong>{{__('general.Summary')}}</strong></h3>
                        <div id="summary" class="pt-3">
                            <h4>{{Session::get('cart')['totalQuantity']}} {{__('general.Products')}} </h4>
                            @php
                                $totalPrice = 0;
                            @endphp
                            @foreach(Session::get('cart') as $cartItem)
                                @if(data_get($cartItem, 'item'))
                                    @php
                                        $item = data_get($cartItem, 'item');
                                        $itemQuantity = data_get($cartItem, 'quantity');
                                        $totalItemPrice = $itemQuantity*$item['price'];
                                        $totalPrice += $totalItemPrice;
                                    @endphp
                                    <div class="d-flex justify-content-between">
                                        <p class="overflow-hidden ml-3" style="max-width: 40%">{{$item['name']}}</p>
                                        <p>X {{$itemQuantity}}</p>
                                        <p>$ {{number_format($totalItemPrice, 0, '.', ',')}}</p>
                                    </div>
                                @endif
                            @endforeach
                            <div class="d-flex justify-content-between">
                                <h4><strong>{{__('general.Total')}}</strong></h4>
                                <h4><strong>$ {{number_format($totalPrice, 0, '.', ',')}}</strong></h4>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h3 class="m-4">{{__('general.empty_cart_message')}}</h3>
                <a class="bg-base btn ml-4" href="/">{{__('general.Continue_shopping')}}</a>
            @endif
        </span>
    </div>

    


@endsection
