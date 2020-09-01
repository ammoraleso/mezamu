@extends('layouts.app')

@section('page_title')
    {{ "MeZamÜ | Welcome" }}
@endsection

@push('stylesAndScripts')
    <link rel="stylesheet" href="{{asset('css/footer/footer-distributed-with-address-and-phones.css')}}">
    <link rel="stylesheet" href="{{asset('css/utils.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('css/flip.css')}}">
@endpush

@section('content')
    <div id="welcome" class="flex-center position-ref full-height">
        <div class="d-lg-flex justify-content-lg-around w-100 align-items-center">
            <div class="text-center mb-5">
                <div class="title mb-3">
                    MezamÜ
                </div>
                <h2 class="mb-5">Tu tienda a un click</h2>
                <a class="btn btn-success" style="font-size: 20px; padding: 7px 35px;" href="{{ route('register') }}">
                    Quiero mi código
                </a>
            </div>
            <div class="position-relative">
                <div id="flip-card" class="flip-card m-auto">
                    <div id="flip-card-inner" class="flip-card-inner">
                        <div class="flip-card-front d-flex">
                            <img class="store m-auto" src="https://mezamublobstorage.blob.core.windows.net/images/store.png">
                        </div>
                        <div id="flip-card-back" class="flip-card-back">
                            <div class="m-auto">{!!QrCode::size(200)->generate('https://mezamu.com')!!}</div>
                        </div>
                    </div>
                </div>
                <img class="cellphone" src="https://mezamublobstorage.blob.core.windows.net/images/cellphone.png">
            </div>
        </div>
    </div>

    <div class="d-lg-flex p-3 m-auto" style="width: 90%">
        <div class="m-auto">
            <h3 style="width: 90%" class="m-auto text-justify">{{__('What we do explanation')}}</h3>
        </div>
    </div>

    <footer style="margin: 0" class="footer-distributed mt-5">

        <div class="footer-left">

            <h3><span>M</span>eZamÜ</h3>
            <p class="footer-company-name mt-4">Todos los Derechos Reservados &copy; 2020</p>
        </div>

        <div class="footer-center">

            <div>
                <i class="fa fa-phone"></i>
                <p>322 243 42 96</p>
            </div>

            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:soporte@intraning.com.co">mezamucorporativo@gmail.com</a></p>
            </div>

        </div>

        <div class="footer-right">

            <p class="footer-company-about">

            </p>

            <div class="footer-icons">

                <!--<a href="#"><i class="fab fa-facebook"></i></a>-->
                <a href="/"><i class="fa fa-instagram"></i></a>

            </div>

        </div>

    </footer>

    <script type="application/javascript">
        var rotated = false;

        window.setInterval(function(){
            if(rotated){
                document.getElementById('flip-card-inner').style.transform = 'rotateY(0)';
            }else{
                document.getElementById('flip-card-inner').style.transform = 'rotateY(180deg)';
            }
            rotated = !rotated;
        }, 3000);
    </script>

    <!--subscribers-->
    <script type="application/javascript">
        var subscribersSiteId = 'cd602984-8642-4484-8a8b-431d84a5faf0';
    </script>
    <script type="application/javascript" src="https://cdn.subscribers.com/assets/subscribers.js"></script>

    <!--google analytics-->
    <script type="application/javascript">
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-128937544-1', 'auto');
        ga('send', 'pageview');
    </script>

    <!--chat de soporte-->
        <!--Para que se dragable pero que no muestre el chat al finalizar el drag-->
        <script type="application/javascript">
            $(function() {
                $( ".draggable" ).draggable({
                    stop: function(event, ui) {
                        $('.purechat-expanded').attr('style', 'display: none!important');
                    }
                });
                $( ".draggable" ).click(function(){
                    $('.purechat-expanded').attr('style', 'display: ');
                });
            });
        </script>
        <!--<script src="https://code.jquery.com/jquery-1.9.1.js"></script> Si se deja se daña el slider y al parecer ya está en otro lugar o no se necesita porque se quita y aún así funciona correctamente el draggable.-->
        <script type="application/javascript" src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <!--fin Para que se dragable pero que no muestre el chat al finalizar el drag-->

        <script type="application/javascript" data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: '1e110dc0-e024-4b2b-a871-4e07f3dec0d3', f: true }); done = true; } }; })();</script>
    <!--fin chat de soporte-->

@endsection
