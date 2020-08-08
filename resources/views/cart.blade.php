@extends('layouts.app')

@section('page_title')
    {{ "MeZamÜ | Shopping" }}
@endsection

@push('stylesAndScripts')
    <link rel="stylesheet" href="{{asset('css/input_number_spinner.css')}}">
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
    <link rel="stylesheet" href="{{asset('css/menu.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{asset('js/cart.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/input_number_spinner.js')}}" type="text/javascript"></script>
    <!--Script for change and remove items from the cart-->
    <script>
        var changeQuantityUrl = '{{route('changeQuantity')}}';
        var removeItemUrl = '{{route('removeItem')}}';
        var checkOutUrl = '{{route('checkOut')}}';
        var findEmailUrl = '{{route('findEmail')}}'
        var saveCustomerUrl = '{{route('saveCustomer')}}'
    </script>

    <!--Script to read QR Code-->

@endpush



@section('content')
    <div class="container-fluid">
        <span id="cartContainer">
            @if(Session::get('cart') && \Illuminate\Support\Arr::get(Session::get('cart'),'totalQuantity') > 0)
                @php 
                    $itemComplete =  data_get(Session::get('cart')[1], 'item');
                    $branchDish = $itemComplete[1];
                    $branch = $branchDish->branch;
                @endphp
                <div style="visibility: hidden; height: 0%;">{{$isScheduleValid = App\Utils\Utils::validateSchedule($branch)}}</div>
                <div class="grid">
                    <div class="accordion" id="accordionExample">
                        <div class="card" style="border-color: white">
                            <div class="card-header tab-header">
                                <h5 class="mb-0">
                                <button class="btn btn-link collapsed tab-category " type="button" data-toggle="collapse" data-target="#collapseProd" aria-expanded="false" aria-controls="collapseTwo">
                                    {{__('general.Products')}}
                                    <img class="arrow-img" src="https://mezamublobstorage.blob.core.windows.net/images/arrow.png">
                                </button>
                                </h5>
                            </div>
                            <div id="collapseProd" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="w-100 mt-3 mr-md-5">
                                        @foreach(Session::get('cart') as $cartItem)
                                            @if(data_get($cartItem, 'item'))
                                                @php 
                                                    $itemComplete = data_get($cartItem, 'item');
                                                    $dish = $itemComplete[0];
                                                    $branchDish = $itemComplete[1];
                                                @endphp
                                                <span id="cartItem{{$dish['id']}}">
                                                    <div class="d-flex p-3 ">
                                                        <img alt="{{$dish->name}}" class="product-img" src="https://mezamublobstorage.blob.core.windows.net/images/{{$dish->photo}}">
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
                                $message = "Hola%20estoy%20pidiendo%20por%20MeZamU%20-%0A";
                                $paymentCart = array();
                            @endphp
                            <div style="justify-content: center; display: flex;">
                                <table>
                                    <tr>
                                        <th class="no-align"><i><h5><strong>{{__('general.Products')}} ({{Session::get('cart')['totalQuantity']}})</strong></h5></i></th>
                                        <th><i><h5><strong>{{__('general.Quantity')}}</strong></h5></i></th>
                                        <th><i><h5><strong>{{__('general.Cost')}}</strong></h5></i></th>
                                    </tr>
                                    @foreach(Session::get('cart') as $cartItem)
                                        @if(data_get($cartItem, 'item'))
                                            @php

                                                $itemComplete = data_get($cartItem, 'item');
                                                $item = $itemComplete[0];
                                                $dishBranch = $itemComplete[1];
                                                $table = Session::get('table');
                                                $itemQuantity = data_get($cartItem, 'quantity');
                                                $itemPrice = $item['price'];
                                                if($dishBranch->promotion)
                                                {
                                                    $itemPrice = $dishBranch->discountPrice();
                                                }
                                                //Calcular el impuesto al consumo.
                                                $totalItemPrice = $itemQuantity*$itemPrice;
                                                $totalPrice += $totalItemPrice;
                                                $message = $message  ."%20". $item->name . "%20(X" . $itemQuantity . ")%20-%20$" . number_format($totalItemPrice, 0, '.', ',') . "%0A" ;
                                                array_push($paymentCart, [$item->id => ['quantity' => $itemQuantity, 'totalItemPrice' => $totalItemPrice]]);
                                            @endphp

                                            <tr>
                                            <td class="no-align">{{$item['name']}}</td>
                                            <td>X {{$itemQuantity}}</td>
                                            <td>$ {{number_format($totalItemPrice, 0, '.', ',')}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td><h4><strong>{{__('general.Total')}}</strong></h4></td>
                                        <td><h4><strong>$ {{number_format($totalPrice, 0, '.', ',')}}</strong></h4></td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                        @php
                            $message = $message  . "Total:%20$" . number_format($totalPrice, 0, '.', ',') . "%0A" . "%2APEDIDO%20PARA%20LA%20MESA%20:%20" . $table."%2A";
                            $message = utf8_encode($message);
                        @endphp
                    </div>
                </div>

                <form onsubmit="return false">
                    <fieldset class="form-group mt-3">
                        <div class="row m-auto" style="width: fit-content">
                            <strong><legend class="col-form-label col-sm-2 pt-0">{{__('To')}}:</legend></strong>
                            <div class="col">
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="toWhere" id="toWhere1" value="table" required>
                                    <label class="form-check-label" for="toWhere1">{{__('Table')}}</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="toWhere" id="toWhere2" value="delivery" required>
                                    <label class="form-check-label" for="toWhere2">{{__('Delivery')}}</label>
                                </div>
                                <!-- <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="toWhere" id="toWhere3" value="takeAway" required>
                                    <label class="form-check-label" for="toWhere3">{{__('Take away')}}</label>
                                </div> -->
                            </div>
                        </div>
                    </fieldset>
                    @if (!$isScheduleValid)
                        <h3 style="color: white; background-color: red; padding: 2%">{{__('general.No_valid_Schedule')}}</h3>
                    @endif
                    <div id="back" class="pt-3" style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
                        <a class="btn btn-danger" href={{Session::get('urlMenu')}}>{{__('general.GoBack')}}</a>
                        @if ($isScheduleValid)
                            <button type="submit" onclick="checkout('{{$dishBranch->branch->email}}','{{utf8_encode($message)}}')" class="btn btn-success">{{__('general.Order')}}</button>
                        @endif
                    </div>
                </form>

                @include('modalConfirmRequest')
                @include('modalDelivery')
            @else
                <div id="back" class="pt-3" style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
                    <img alt="empty_cart" class="product-img" src="https://mezamublobstorage.blob.core.windows.net/images/empty-cart.png">
                </div>
                <h3 class="m-4" style="font-style: oblique; text-align: justify;"><b>{{__('general.empty_cart_message')}}</b></h3>
                <div id="back" class="pt-3" style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
                    <a class="btn btn-danger" href={{Session::get('urlMenu')}}>{{__('general.GoBack')}}</a>
                </div>
            @endif
        </span>
    </div>

@endsection


