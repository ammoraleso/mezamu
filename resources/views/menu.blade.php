@extends('layouts.app')

@section('page_title')
    {{ "MeZamÜ | Ménu" }}
@endsection

@push('stylesAndScripts')
    <link rel="stylesheet" href="{{asset('css/menu.css')}}">
    <link rel="stylesheet" href="{{asset('css/input_number_spinner.css')}}">
    <script src="{{asset('js/input_number_spinner.js')}}" type="text/javascript"></script>
@endpush

@section('content')

    <div class="p-2">
        @foreach($categories as $category)
            <h5 style="font-weight: bolder">{{$category->description}}</h5>
            @foreach($branchDishes as $branchDish)
                @php($dish = $branchDish->dish)
                @if($dish->category == $category)
                    <div class="d-flex p-3">
                        <img alt="{{$dish->name}}" class="product-img" src="/images/{{$dish->photo}}">
                        <div class="ml-3 w-100 d-flex flex-column">
                            <div>
                                <strong><p class="mb-0 d-inline-block">{{$dish->name}}
                                        @if($branchDish->promotion)
                                            <span class="badge badge-danger discount-badge">{{$branchDish->discountPercentage()}}%</span>
                                        @endif
                                    </p></strong>

                            </div>
                            <small><p class="ellipsis menu-description m-0">{{$dish->description}}</p></small>
                            <div class="d-flex flex-column-reverse h-100">
                                <div class="d-flex w-100" style="justify-content: space-between">
                                    <div class="price-container">
                                        @if($branchDish->promotion)
                                            <strong class="mr-2">${{number_format($branchDish->discountPrice(), 0, '.', ',')}}</strong>
                                        @endif
                                        <span class="{{$branchDish->promotion ? 'before-price' : '' }}">${{number_format($dish->price, 0, '.', ',')}}</span>
                                    </div>
                                    <form id="addItemForm" autocomplete="off">
                                        <div class="quantity mb-3">
                                            <input id="quantity" name="quantity" type="number" min="1" max="100" step="1" value="1" class="bg-transparent" readonly="true"><!--we use readonly instead of disable because with the last one the data is not send in the request-->
                                        </div>
                                        <button type="submit" class="btn btn-success">{{__('general.Add_to_cart')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                @endif
            @endforeach
        @endforeach
    </div>

@endsection
