@extends('layouts.app')

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
                                                                    <div class="addItems" style="inline-grid">
                                                                        <div class="quantity mb-3">
                                                                            <input onchange="changeQuantity({{$dish}}, this.value);" id="quantity" name="quantity" type="number" min="1" max="100" step="1" value="{{data_get($cartItem, 'quantity')}}" class="bg-transparent" readonly="true"><!--we use readonly instead of disable because with the last one the data is not send in the request-->
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
                            <h4>{{Session::get('cart')['totalQuantity']}} {{__('general.Products')}} </h4>
                            @php
                                $totalPrice = 0;
                            @endphp
                            @foreach(Session::get('cart') as $cartItem)
                                @if(data_get($cartItem, 'item'))
                                    @php
                                        $itemComplete = data_get($cartItem, 'item');
                                        $item = $itemComplete[0];
                                        $dishBranch = $itemComplete[1];
                                        $itemQuantity = data_get($cartItem, 'quantity');
                                        //TODO traer el precio de promocion
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
            <hr>
            <div id="back" class="pt-3"style="justify-content: center; display: flex; padding-bottom: 1%;">
                <input type="button" onclick="history.back()" name="volver" class="btn btn-success" value="volver">
            </div>
        </span>
    </div>
@endsection
