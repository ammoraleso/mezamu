@extends('layouts.app')

@section('page_title')
    {{ "MeZamÜ | Shopping" }}
@endsection

@section('title') {{ __('general.My_Cart')}} @endsection

@push('stylesAndScripts')
    <link rel="stylesheet" href="{{asset('css/input_number_spinner.css')}}">
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
    <link rel="stylesheet" href="{{asset('css/menu.css')}}">
    <script src="{{asset('js/cart.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/input_number_spinner.js')}}" type="text/javascript"></script>
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
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseProd" aria-expanded="false" aria-controls="collapseTwo">
                                    {{__('general.Products')}}
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
                                                        <img alt="{{$dish->name}}" class="product-img" src="/images/{{$dish->photo}}">
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
                                $message = "Hola%20mi%20pedido%20es%20:%0A";
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
                                                $itemQuantity = data_get($cartItem, 'quantity');
                                                $itemPrice = $item['price'];
                                                if($dishBranch->promotion)
                                                {
                                                    $itemPrice = $dishBranch->discountPrice();
                                                }
                                                //Calcular el impuesto al consumo.
                                                $totalItemPrice = $itemQuantity*$itemPrice;
                                                $totalPrice += $totalItemPrice;
                                                $message = $message  . $item->name . "%20(X" . $itemQuantity . ")%20-%20$" . number_format($totalItemPrice, 0, '.', ',') . "%0A";
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
                            $message = $message  . "Total:%20$" . number_format($totalPrice, 0, '.', ',');
                            $message = utf8_encode($message);
                        @endphp
                    </div>
                </div>
            @else
                <h3 class="m-4">{{__('general.empty_cart_message')}}</h3>
                <a class="bg-base btn ml-4" href="/">{{__('general.Continue_shopping')}}</a>
            @endif
            <hr>
            <div id="back" class="pt-3"style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
                <a class="btn btn-danger" href="{{url()->previous()}}">Volver</a>
                @if(Session::get('cart') && \Illuminate\Support\Arr::get(Session::get('cart'),'totalQuantity') > 0)
                    <a id="mia" href="https://api.whatsapp.com/send?phone={{$dishBranch->branch->telefono}}&text={{utf8_encode($message)}}" class="btn btn-success" target="_blank">Ordenar</a>
                @endif
            </div>
        </span>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#mia').click(function(){
            //we will send data and recive data fom our AjaxController
            $.ajax({
                url:'{{route('clearCart')}}',
                data:{},
                type:'post',
                success: function (response) {
                },
                statusCode: {
                    404: function() {
                        console.log('web not found');
                    }
                },
                error:function(x,xs,xt){
                    //nos dara el error si es que hay alguno
                    window.open(JSON.stringify(x));
                    //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                }
            });
        });
    </script>
@endsection
