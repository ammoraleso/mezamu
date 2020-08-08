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
                    <div id="perfil-form" style="visibility: hidden">
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

                        <div class="flex-grow-1 mx-auto mt-3">
                            <button id="submitButton" class="btn bg-base w-100 mb-3 btn-success"
                                    onclick="showPayModal()" type="button">{{__('general.Continue')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript" src="https://checkout.epayco.co/checkout.js">   </script> 
    <!-- Script to use Input Email pattern Property -->
    <script>  
        function myGeeks() {  
            var em = document.getElementById("email").pattern; 
        }  
    </script>  

    <!--PAYMENT-->
    <script>
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
        };

        async function showPayModal() {
            $name = $('#name').val();
            //$city = $('#city').val();
            $city = 1;
            $address = $('#address').val();
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
            if(!$address){
                $('#address').focus();
                $('#address').addClass('is-invalid');
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

