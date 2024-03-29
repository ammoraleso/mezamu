<!-- Modal go to cart-->
<div class="modal fade" id="modalDelivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-auto text-center modal-header">{{__('general.Delivery_Form')}}</h5>
                <button type="button" class="close m-0 p-0 modal-close-button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-auto">
                <form id="myForm">

                    <div class="input-group">
                        <div class="form-group flex-grow-1">
                            <label class="control-label">{{__('general.Email')}}
                                <small>({{__('general.required')}})</small>
                            </label>
                            <input id="email" class="modal-input" type="text" placeholder="Search.." name="search">
                            <button class="modal-button" type="button" onclick="loadPerfil({{$branch->latitude}},{{$branch->longitude}})"><i class="fa fa-search"></i></button>

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
                                <input onfocus="changeAutocomplete()" onchange="resetDistance()" id="address" name="address" autocomplete="nope" type="text" class="form-control" required style="background-image: none!important;" size="50">
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="form-group flex-grow-1">
                                <label class="control-label">{{__('general.Aditional_address')}}</label>
                                <input id="aditional_address" name="aditional_address" type="text" class="form-control" required style="background-image: none!important;" placeholder="Ej: Interior 1 Apto 101">
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

                        <input type="checkbox" checked="true" id="cbTerms" value="second_checkbox" required> <label style="color: #2196f3; text-decoration:underline;" type="button" for="cbox2" onclick="showModalTerms();">Aceptar Terminos y Condiciones</label>

                        <div class="flex-grow-1 mx-auto mt-3">
                            <button id="submitButton" class="btn bg-base w-100 mb-3 btn-success"
                                    onclick="showPayModal({{$branch }})" type="button">{{__('general.Continue')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!--maps-->
    <script type="application/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPX6_gpXpuH1S288yA_Ip9tR-YSqVy2Dk&callback=initMap&libraries=places,geometry" async defer></script>
    <script type="application/javascript">
        let distance = 100000;
        function initMap() {
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener("place_changed", () => {
                var deliveryAddress = autocomplete.getPlace().geometry.location;
                distance = google.maps.geometry.spherical.computeDistanceBetween(deliveryAddress, new google.maps.LatLng({{Arr::first(Session::get('cart'))['item']->branch->latitude}}, {{Arr::first(Session::get('cart'))['item']->branch->longitude}}));
            });
        }
        <!--prevents browser to autocomplete-->
        function changeAutocomplete() {
            document.getElementById('address').autocomplete = "invalid";
        }
        function resetDistance() {
            distance = 100000;
        }
    </script>
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/maps.css')}}">


    <!-- Script to use Input Email pattern Property -->
    <script type="application/javascript">
        function myGeeks() {
            var em = document.getElementById("email").pattern;
        }
    </script>

