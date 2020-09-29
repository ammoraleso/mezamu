@extends('layouts.app')

@section('page_title')
    {{ "MeZamÜ | Ménu" }}
@endsection

@push('stylesAndScripts')
    <link rel="stylesheet" href="{{asset('css/menu.css')}}">
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
    <link rel="stylesheet" href="{{asset('css/input_number_spinner.css')}}">
    <script src="{{asset('js/input_number_spinner.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/cart.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/menu.js')}}" type="text/javascript"></script>
    <script>
        //Route used in menu.js to call the post method addItem.
        var addItemUrl = '{{ route('addItem') }}';
    </script>
@endpush

@section('content')

    @include('modalDetails')

    <div class="pt-4 div-logo">
        <img alt="Mezamu Logo" class="product-img" src="https://mezamublobstorage.blob.core.windows.net/{{$restaurant->slug}}/{{$restaurant->logo}}">
    </div>
    
    @if (!$isScheduleValid)
        <h3 style="color: white; background-color: red;padding: 2%">{{__('general.No_valid_Schedule')}}</h3>
    @endif

    <div class="panel-group">
        <div class="accordion" id="accordionExample">
            @for($i =0; $i <count($categories); $i++)
                <div class="card">
                    <div class="card-header tab-header">
                        <h5 class="mb-0">
                        <button class="btn btn-link tab-category" onclick="collapseTab({{$categories[$i]->id}})" type="button">
                            {{$categories[$i]->description }}
                            <img class="arrow-img" src="https://mezamublobstorage.blob.core.windows.net/images/arrow.png">
                        </button>

                        </h5>
                    </div>
                    <div id="collapse{{$categories[$i]->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            @foreach($branchDishes as $branchDish)
                                @php
                                    $dish = $branchDish->dish
                                @endphp

                                @if($dish->category ==$categories[$i])

                                    <div class="d-flex p-3 ">
                                        <img onclick="showDetails({{$dish}})" alt="{{$dish->name}}" class="product-img" type="button" src="https://mezamublobstorage.blob.core.windows.net/{{$restaurant->slug}}/{{$dish->photo}}">
                                        <div class="ml-3 w-100 d-flex flex-column">
                                            <div>
                                                <strong><p class="mb-0 d-inline-block">{{$dish->name}}
                                                        @if($branchDish->promotion)
                                                            <span class="badge badge-danger discount-badge">{{$branchDish->discountPercentage()}}%</span>
                                                        @endif
                                                    </p>
                                                </strong>

                                            </div>
                                            <small><p class="ellipsis menu-description m-0">{{$dish->description}}</p></small>
                                            @if ($isScheduleValid)
                                                <div class="d-flex flex-column-reverse h-100" style="padding-top: 2%;">
                                                    <div class="addItems">
                                                        <div class="quantity mb-3">
                                                            <input id="quantity{{$dish->id}}" name="quantity{{$dish->id}}" type="number" min="1" max="100" step="1" value="1" class="bg-transparent" readonly="true"><!--we use readonly instead of disable because with the last one the data is not send in the request-->
                                                        </div>

                                                        <button type="submit" class="btn btn-success" onclick="addItem({{$dish}},{{$branchDish}});">
                                                            {{__('general.Add_to_cart')}}
                                                        </button>
                                                    </div>
                                                    <div class="d-flex w-100">
                                                        <div class="price-container">
                                                            @if($branchDish->promotion)
                                                                <strong class="mr-2">${{number_format($branchDish->discountPrice(), 0, '.', ',')}}</strong>
                                                            @endif
                                                            <span class="{{$branchDish->promotion ? 'before-price' : '' }}">${{number_format($dish->price, 0, '.', ',')}}</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <hr/>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <div id="back" class="pt-3"style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
        <a class="btn btn-success" href="{{route('cart')}}">{{__('general.GoToCart')}}</a>
    </div>
@endsection
