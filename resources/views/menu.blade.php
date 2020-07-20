<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- bootstrap 4.1.0 -->
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

            <!-- Popper JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

            <!-- Latest compiled JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <!-- End bootstrap -->

        <link rel="stylesheet" href="{{asset('css/menu.css')}}">

        <link rel="stylesheet" href="{{asset('css/ellipsis.css')}}">
    </head>
    <body>
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
                                    <button class="btn btn-success">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                @endif
            @endforeach
        @endforeach
    </div>
    </body>
</html>
