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
            <form id="mesero-form" action="{{ route('generateCode') }}" method="POST">
                @csrf
                <input type="hidden" name="restaurantId" id="restaurantId" value="{{$restaurant->id}}">
                <input type="hidden" name="branchName" id="branchName" value="{{$branchName}}">

                <div class="form-group label-floating">
                    <label class="control-label">{{__('Table')}}</label>
                    <select class="form-control" id="table" name="table" required>
                        <option disabled selected value style="display:none"></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <button type="submit" onclick="generateCode()" class="btn btn-success">{{ __('Generate Code') }}</button>
            </form>
            @isset($table,$token)
                <div class="p-3">
                    <div class="m-auto" style="width: fit-content">{!!QrCode::generate('http://127.0.0.1/'.$restaurant->slug.'/'.$branchName.'/'.$table.'/'.$token)!!}</div>
                </div>
            @endisset
        </div>
    </body>

</html>
