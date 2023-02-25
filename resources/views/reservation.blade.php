@extends('layouts.app')

@section('page_title')
    {{ "MeZamÜ | Ménu" }}
@endsection

@push('stylesAndScripts')
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/cart.css')}}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/menu.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/input_number_spinner.css')}}">
    <script src="{{ Vite::asset('resources/js/datePicker.js')}}" type="text/javascript"></script>
    <script src="{{ Vite::asset('resources/js/input_number_spinner.js')}}" type="text/javascript"></script>
    <script src="{{ Vite::asset('resources/js/cart.js')}}" type="text/javascript"></script>
    <script>
        //Route used in menu.js to call the post method addItem.
        var findEmailUrl = '{{route('findEmail')}}';
    </script>

@endpush

@section('content')

    <div class="pt-4 div-logo">
        <img alt="Mezamu Logo" class="product-img" src="https://mezamublobstorage.blob.core.windows.net/images/{{$restaurant->logo}}">
    </div>
    <div class="panel-group">

        <div role="document">
            <div class="modal-content">
                <div class="tab-reservation">
                    <h6 class="modal-title m-auto text-center modal-header">{{__('general.Reserve_Form')}}</h6>
                </div>
                <div class="modal-body m-auto">
                    <form id="myForm">

                        <div class="input-group">
                            <div class="form-group flex-grow-1">
                                <label class="control-label">{{__('general.Email')}}
                                    <small>({{__('general.required')}})</small>
                                </label>
                                <input id="email" class="modal-input" type="text" placeholder="Search.." name="search">
                                <button class="modal-button" type="button" onclick="loadPerfil()"><i class="fa fa-search"></i></button>

                            </div>
                        </div>
                        <hr>
                        <div id="perfil-form" style="display: none">
                            <div class="input-group">
                                <div class="form-group flex-grow-1">
                                    <label class="control-label">{{__('general.Delivery_Name')}}
                                        <small>({{__('general.required')}})</small>
                                    </label>
                                    <input id="name" name="name" type="text" class="form-control" required style="background-image: none!important;">
                                </div>
                            </div>

                            <div class="input-group">
                                <div class="form-group flex-grow-1">
                                    <label class="control-label">{{__('general.Address')}}
                                        <small>({{__('general.required')}})</small>
                                    </label>
                                    <input id="address" name="address" type="text" class="form-control" required style="background-image: none!important;">
                                </div>
                            </div>

                            <div class="input-group">
                                <div class="form-group flex-grow-1">
                                    <label class="control-label">{{__('general.Phone')}}
                                        <small>({{__('general.required')}})</small>
                                    </label>
                                    <input id="phone" name="phone" type="text" class="form-control" required style="background-image: none!important;">
                                </div>
                            </div>

                            <div class="input-group">
                                <div class="form-group flex-grow-1">
                                    <label class="control-label">{{__('general.Persons')}}
                                        <small>({{__('general.required')}})</small>
                                    </label>
                                    <div class="quantity right" style="float: right;">
                                        <input id="persons" name="persons" type="number" min="1" max="100" step="1" value="1" class="bg-transparent" readonly="true"><!--we use readonly instead of disable because with the last one the data is not send in the request-->
                                    </div>
                                </div>
                            </div>

                            <div class="input-group">
                                <div class="form-group flex-grow-1">
                                    <label class="control-label">Fecha
                                        <small>({{__('general.required')}})</small>
                                    </label>
                                    <input style="float: right;" id="datefield" type='date' min='1899-01-01' max='2099-12-12'>
                                </div>
                            </div>

                            <div class="input-group">
                                <div class="form-group flex-grow-1">
                                    <label class="control-label">Hora
                                        <small>({{__('general.required')}})</small>
                                    </label>
                                    <input style="float: right;"  type="time" id="appt" name="appt" min="09:00" max="18:00">
                                </div>
                            </div>
                            <div class="flex-grow-1 mx-auto mt-3">
                                <button id="submitButton" class="btn bg-base w-100 mb-3 btn-success"
                                        onclick="showPayModal()" type="button">{{__('general.Reserve')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div id="back" class="pt-3" style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
        <a class="btn btn-danger" href={{Session::get('urlMenu')}}>{{__('general.GoBack')}}</a>
    </div>

    <script>
        let today = new Date();
            let dd = today.getDate();
            let mm = today.getMonth()+1; //January is 0!
            let yyyy = today.getFullYear();
            if(dd<10){
                    dd='0'+dd
                }
                if(mm<10){
                    mm='0'+mm
                }

            today = yyyy+'-'+mm+'-'+dd;
            document.getElementById("datefield").setAttribute("min", today);
    </script>

@endsection
