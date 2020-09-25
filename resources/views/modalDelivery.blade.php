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

                        <div class="flex-grow-1 mx-auto mt-3">
                            <button id="submitButton" disabled class="btn bg-base w-100 mb-3 btn-success"
                                    onclick="showPayModal()" type="button">{{__('general.Continue')}}</button>
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
        let distance = 0;
        let isCovered = false;
        function initMap() {
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input);

            document.getElementById("submitButton").disabled = isCovered;

            autocomplete.addListener("place_changed", () => {
                var deliveryAddress = autocomplete.getPlace().geometry.location;
                distance = google.maps.geometry.spherical.computeDistanceBetween(deliveryAddress, new google.maps.LatLng({{Arr::first(Session::get('cart'))['item']->branch->latitude}}, {{Arr::first(Session::get('cart'))['item']->branch->longitude}}));
                isCovered = distance < {{Arr::first(Session::get('cart'))['item']->branch->coverage}};
            });
        }
        <!--prevents browser to autocomplete-->
        function changeAutocomplete() {
            document.getElementById('address').autocomplete = "invalid";
        }
        function resetDistance() {
            distance = 0;
        }

    </script>
    <link rel="stylesheet" href="{{asset('css/maps.css')}}">

    <script type="application/javascript" src="https://checkout.epayco.co/checkout.js"></script>
    <!-- Script to use Input Email pattern Property -->
    <script type="application/javascript">
        function myGeeks() {
            var em = document.getElementById("email").pattern;
        }
    </script>

    <!--PAYMENT-->
    <script type="application/javascript">
        var handler = ePayco.checkout.configure({
            key:'f2896c38764f97526a193f24de170b96',
            //key: '71c83236ba0231c2d3e4048be66fc298',//intraining
            test: true
        });
        var data={
            //Parametros compra (obligatorio)
            name: "{{__('general.transaction_name')}}",
            description: "{{__('general.transaction_name')}}",
            invoice: "",
            currency: "cop",
            tax_base: "0",
            tax: "0",
            country: "co",
            lang: "es",

            //Onpage="false" - Standard="true"
            external: "true",

            //Atributos opcionales
            response: '{{\App\Utils\Utils::generateUrl()}}'+'/api/response_payment',

            //atributo deshabilitación metodo de pago
            methodsDisable: ["SP","CASH"],
        };

        async function showPayModal() {
            $name = $('#name').val();
            //$city = $('#city').val();
            $city = 1;
            $address = $('#address').val();
            $aditionalAddress = $('#aditional_address').val();
            $phone = $('#phone').val();
            if(!$name) {
                $('#name').focus();
                $('#name').addClass('is-invalid');
                return;
            }else{
                $('#name').removeClass('is-invalid');
            }

            if(!$city){
                $('#city').focus();
                $('#city').addClass('is-invalid');
                return;
            }else{
                $('#city').removeClass('is-invalid');
            }
            if(!$address || distance === 0){
                $('#address').focus();
                $('#address').addClass('is-invalid');
                if(distance === 0){
                    alert('Por favor seleccione una dirección valida')
                }
                return;
            }else{
                $('#address').removeClass('is-invalid');
            }
            if(!$phone){
                $('#phone').focus();
                $('#phone').addClass('is-invalid');
                return;
            }else{
                $('#phone').removeClass('is-invalid');
            }
            if(!isCovered){
                alert('Tu ubicación está fuera del rango del restaurante');
                return;
            }

            data.amount='{{$totalPrice}}';
            data.extra1= '{!! json_encode($paymentCart)!!}'.replace(/"/g, "'");
            data.extra2= $city;
            data.extra3= $address;
            data.extra4= $name;
            //Atributos cliente
            data.type_doc_billing= "cc";
            try {
                await $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    url: saveCustomerUrl,
                    data: {
                        email: $email,
                        name: $name,
                        address: $address,
                        phone: $phone
                    },
                    type: "post"
                });
            } catch (error) {
                console.log("Error saving Customer: " + error);
            }
            handler.open(data)
        }
    </script>
    <!--PAYMENT-->

