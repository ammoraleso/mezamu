@extends('layouts.app')

@section('page_title')
    {{ "MeZamÜ | Ménu" }}
@endsection

@push('stylesAndScripts')
    <link rel="stylesheet" href="{{asset('css/menu.css')}}">
    <link rel="stylesheet" href="{{asset('css/input_number_spinner.css')}}">
    <script src="{{asset('js/input_number_spinner.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/menu.js')}}" type="text/javascript"></script>
    <script>
        //Route used in menu.js to call the post method addItem.
        var addItemUrl = '{{ route('addItem') }}';
    </script>
@endpush

@section('content')

    <div class="panel-group">
        <div class="accordion" id="accordionExample">
            @foreach($categories as $category)
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$category->id}}" aria-expanded="false" aria-controls="collapseTwo">
                            {{$category->description}}
                        </button>
                        </h5>
                    </div>
                    <div id="collapse{{$category->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            @foreach($branchDishes as $branchDish)
                                @php($dish = $branchDish->dish)
                                @if($dish->category == $category)
                                    
                                    <div class="d-flex p-3 ">
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
                                                    <div class="addItems" style="inline-grid">
                                                        <div class="quantity mb-3">
                                                            <input id="quantity{{$dish->id}}" name="quantity{{$dish->id}}" type="number" min="1" max="100" step="1" value="1" class="bg-transparent" readonly="true"><!--we use readonly instead of disable because with the last one the data is not send in the request-->
                                                        </div>                                       
                                                        
                                                        <button type="submit" class="btn btn-success" onclick="addItem({{$dish}});">
                                                            {{__('general.Add_to_cart')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
