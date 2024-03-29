@extends('layouts.app')

@section('page_title')
    {{ "MeZamÜ | Shopping" }}
@endsection

@push('stylesAndScripts')
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/input_number_spinner.css')}}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/cart.css')}}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/menu.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ Vite::asset('resources/js/cart.js')}}" type="text/javascript"></script>
    <script src="{{ Vite::asset('resources/js/checkout.js')}}" type="text/javascript"></script>
    <script src="{{ Vite::asset('resources/js/input_number_spinner.js')}}" type="text/javascript"></script>
    <!--Script for change and remove items from the cart-->
    <script type="text/javascript">
        var changeQuantityUrl = '{{route('changeQuantity')}}';
        var removeItemUrl = '{{route('removeItem')}}';
        var checkOutUrl = '{{route('checkOut')}}';
        var findEmailUrl = '{{route('findEmail')}}';
        var saveCustomerUrl = '{{route('saveCustomer')}}';
        var checkOutDeliveryURL = '{{route('checkOutDelivery')}}';
    </script>
@endpush

@section('content')
    <div class="container-fluid">
        <span id="cartContainer">
            @if(Session::get('cart') && Session::get('totalQuantity') > 0)
                @php
                    $isScheduleValid = App\Utils\Utils::validateSchedule(Arr::first(Session::get('cart'))['item']->branch);
                    $branch = Arr::first(Session::get('cart'))['item']->branch;
                    $restaurant = $branch->restaurant
                @endphp

                <div class="grid">
                    <div class="accordion" id="accordionExample">
                        <div class="card" style="border-color: white">
                            <div class="card-header tab-header">
                                <h5 class="mb-0">
                               <button class="btn btn-link tab-category" onclick="collapseTab()" type="button">
                                    {{__('general.Edit_Order')}}
                                    <img class="arrow-img" src="{{Vite::asset('resources/images/arrow.png')}}">
                                </button>
                                </h5>
                            </div>
                            <div id="collapseProd" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="w-100 mt-3 mr-md-5">
                                        @foreach(Session::get('cart') as $cartItem)
                                            @if(data_get($cartItem, 'item'))
                                                @php
                                                    $branchDish = data_get($cartItem, 'item');
                                                    $dish = $branchDish->dish;
                                                @endphp
                                                <span id="cartItem{{$dish['id']}}">
                                                    <div class="d-flex p-3 ">
                                                    <img alt="{{$dish->name}}" class="product-img" src="{{Vite::asset('resources/'.$restaurant->slug.'/'.$dish->photo)}}">
                                                        <div class="ml-3 w-100 d-flex flex-column">
                                                            <div>
                                                                <strong>
                                                                    <p class="mb-0 d-inline-block">{{$dish->name}}
                                                                        @if($branchDish->promotion)
                                                                            <span class="badge badge-danger discount-badge">{{$branchDish->discountPercentage()}}%</span>
                                                                        @endif
                                                                    </p>
                                                                </strong>
                                                            </div>
                                                            <small><p class="ellipsis menu-description m-0">{{$dish->description}}</p></small>
                                                            <div class="d-flex flex-column-reverse h-100">
                                                                <div class="d-flex w-100" style="justify-content: space-between">
                                                                    <div class="price-container">
                                                                        @if($branchDish->promotion)
                                                                            <strong class="mr-2">${{number_format($branchDish->discountPrice(), 0, '.', ',')}}</strong>
                                                                        @endif
                                                                        <span class="{{$branchDish->promotion ? 'before-price' : '' }}">${{number_format($dish->price, 0, '.', ',')}}</span>
                                                                        <strong class="mt-2 mt-md-0 mb-0">$ {{$dish['formatedPrice']}} c/u</strong>
                                                                    </div>
                                                                    <div class="addItems">
                                                                        <div class="quantity mb-3">
                                                                            <input onchange="changeQuantity({{$dish}}, this.value);" id="quantity" name="quantity" type="number" min="1" max="100" step="1" value="{{data_get($cartItem, 'quantity')}}" class="bg-transparent" readonly="true"><!--we use readonly instead of disable because with the last one the data is not send in the request-->
                                                                        </div>
                                                                        <div class="quantity mb-3">
                                                                            <a onclick="removeItem({{$dish}});" href="#" style="color: currentColor"><u>{{__('general.Delete')}}</u></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="w-md-40 px-md-3 pt-md-3 mt-4 mt-md-0 card-md rounded-20px" style="height: fit-content">
                        <h3><strong>{{__('general.Summary')}}</strong></h3>
                        <div id="summary" class="pt-3">
                            @php
                                $totalPrice = 0;
                                $paymentCart = array();
                            @endphp
                            <div style="justify-content: center; display: flex;">
                                <table>
                                    <tr>
                                        <th class="no-align"><i><h5><strong>{{__('general.Products')}} ({{Session::get('totalQuantity')}})</strong></h5></i></th>
                                        <th><i><h5><strong>{{__('general.Quantity')}}</strong></h5></i></th>
                                        <th><i><h5><strong>{{__('general.Cost')}}</strong></h5></i></th>
                                    </tr>
                                    @foreach(Session::get('cart') as $cartItem)
                                        @if(data_get($cartItem, 'item'))
                                            @php

                                                $itemComplete = data_get($cartItem, 'item');
                                                $table = Session::get('table');
                                                $itemQuantity = data_get($cartItem, 'quantity');
                                                $itemPrice = $itemComplete->dish['price'];
                                                if($itemComplete->promotion)
                                                {
                                                    $itemPrice = $itemComplete->discountPrice();
                                                }
                                                //Calcular el impuesto al consumo.
                                                $totalItemPrice = $itemQuantity*$itemPrice;
                                                $totalPrice += $totalItemPrice;
                                                array_push($paymentCart, [$itemComplete->dish->id => ['quantity' => $itemQuantity, 'totalItemPrice' => $totalItemPrice]]);
                                            @endphp
                                            <tr>
                                            <td class="no-align">{{$itemComplete->dish['name']}}</td>
                                            <td>X {{$itemQuantity}}</td>
                                            <td>$ {{number_format($totalItemPrice, 0, '.', ',')}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <input id="totalPrice" hidden value="{{$totalPrice}}"/>
                                    <input id="totalPriceBase" hidden value="{{$totalPrice}}"/>
                                    <tr id="rowDelivery" style="display: none">
                                        <td class="no-align">{{__('general.Delivery')}}</td>
                                        <td>-</td>
                                        <td><h4>$ {{number_format($branch->delivery_price, 0, '.', ',')}}</h4></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><h4><strong>{{__('general.Total')}}</strong></h4></td>
                                        <td><h4 id="totalPriceTable"><strong>$ {{number_format($totalPrice, 0, '.', ',')}}</strong></h4></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <form onsubmit="return false">
                    <fieldset class="form-group mt-3">
                        <div class="row m-auto" style="width: fit-content">
                            <strong class="centerText">{{__('Payment Type')}}:</strong>
                            <div class="col">
                                <!--<div class="form-check-inline">
                                    <input id="radioInSitu" onclick="updateDelivery(false,{{$branch->delivery_price}});" class="form-check-input" type="radio" name="toWhere" id="toWhere1" value="table" required>
                                    <label class="form-check-label" for="toWhere1">{{__('Table')}}</label>
                                </div>
                                <div class="form-check-inline">
                                    <input id="radioDelivery" onclick="updateDelivery(true,{{$branch->delivery_price}});" class="form-check-input" type="radio" name="toWhere" id="toWhere2" value="delivery" required>
                                    <label class="form-check-label" for="toWhere2">{{__('Delivery')}}</label>
                                </div>
                                -->
                                <!-- <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="toWhere" id="toWhere3" value="takeAway" required>
                                    <label class="form-check-label" for="toWhere3">{{__('Take away')}}</label>
                                </div> -->
                                <div id="comboPaymentType" class="form-group mt-3 ">
                                    <select name="paymentType" id="paymentType" class="form-control" required>
                                        <option value="">Seleccionar</option>
                                        @foreach($paymentTypeArray as $key => $paymentType)
                                            <option value="{{$key}}">{{$paymentType}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div id="descriptionOrderDiv" class="pt-3" style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
                        <textarea style="resize: none; width: 80%;" id="descriptionOrder" placeholder="Ingresa aquí tus comentarios adicionales.." rows="4" cols="50"></textarea>
                    </div>
                    @if (!$isScheduleValid)
                        <h3 style="color: white; background-color: red; padding: 2%">{{__('general.No_valid_Schedule')}}</h3>
                    @endif
                    <div id="back" class="pt-3" style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
                        <a class="btn btn-danger" href={{Session::get('urlMenu')}}>{{__('general.GoBack')}}</a>
                        @if ($isScheduleValid)
                            <button type="submit" onclick="checkout()" class="btn btn-success">{{__('general.Order')}}</button>
                        @endif
                    </div>
                </form>

                @include('modalConfirmRequest')
                @include('modalTerms')
            @else
                <div id="back" class="pt-3" style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
                    <img alt="empty_cart" class="product-img" src="{{Vite::asset('resources/images/empty-cart.png')}}">
                </div>
                <h3 class="m-4" style="font-style: oblique; text-align: justify;"><b>{{__('general.empty_cart_message')}}</b></h3>
                <div id="back" class="pt-3" style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
                    <a class="btn btn-danger" href={{Session::get('urlMenu')}}>{{__('general.GoBack')}}</a>
                </div>
            @endif
        </span>
    </div>
@endsection

@push('finalScripts')
    <script type="application/javascript" src="https://checkout.epayco.co/checkout.js"></script>
    <!--PAYMENT-->
    <script type="application/javascript">
        var handler = ePayco.checkout.configure({
            key:"{{env('EPAYCO_PUBLIC_KEY')}}",
            test: Boolean({{env('EPAYCO_TEST')}})
        });
        var data={
            //Parametros compra (obligatorio)
            name: "{{__('general.transaction_name')}}",
            description: "{{__('general.transaction_name')}}",
            invoice: "",
            currency: "cop",
            tax_base: "0",
            tax: "0",
            country: "co",
            lang: "es",

            //Onpage="false" - Standard="true"
            external: "true",

            //Atributos opcionales
            response: '{{\App\Utils\Utils::generateUrl()}}'+'/api/response_payment',

            //atributo deshabilitación metodo de pago
            methodsDisable: ["SP","CASH"],
        };
    </script>
    <!--PAYMENT-->
@endpush
