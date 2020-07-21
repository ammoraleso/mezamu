@extends('layouts.app')

@section('page_title')
    {{ "MeZamÜ | Home" }}
@endsection

@section('content')

    <link rel="stylesheet" href="{{asset('css/footer/footer-distributed-with-address-and-phones.css')}}">
    <link rel="stylesheet" href="{{asset('css/carousel.css')}}">
    <link rel="stylesheet" href="{{asset('css/utils.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div id="welcome" class="flex-center position-ref full-height">
        <div class="content">
            <div class="title mb-3">
                Bienvenido a MeZamü​
            </div>
            <div>
                <div>
                    <h4 >MeZamÜ facilita los protocolos de bioseguridad alineados a los estándares de atención
                        y satisfacción al cliente, junto con el mejoramiento de los estándares de servicio y optimización
                        de costos al enfocarse en una tendencia virtual y digitalizada.</h4>
                </div>
            </div>

            <button class="btn button_app" style="font-size: 20px;" href="/">
                Conocenos
            </button>
        </div>
    </div>


    <footer style="margin: 0" class="footer-distributed">

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
    <script>
        $(document).ready(function() {
            var itemsPerSlide = 3;
            var totalItems = $(".carousel-item").length;
            if(itemsPerSlide >= totalItems){//se ocultan las flechas de mover el carrousel cuando tiene 3 o menos items para mostrar
                $("a[class^='carousel-control-']").css('display', 'none');
            }

            $("#myCarousel").on("slide.bs.carousel", function(e) {

                if(itemsPerSlide >= totalItems) {//solo se mueve el carousel cuando hay más de 3 cards
                    return false
                }

                var $e = $(e.relatedTarget);
                var idx = $e.index();
                console.log('indice: '+idx);
                if (idx >= totalItems - (itemsPerSlide - 1)) {
                    var it = itemsPerSlide - (totalItems - idx);
                    console.log('otro: '+it);
                    for (var i = 0; i < it; i++) {
                        // append slides to end
                        if (e.direction == "left") {
                            $(".carousel-item")
                                .eq(i)
                                .appendTo(".carousel-inner");
                        } else {
                            $(".carousel-item")
                                .eq(0)
                                .appendTo(".carousel-inner");
                        }
                    }
                    /*$(".media-slider").css('width', '100');*/
                }


            });
            /*$("#myCarousel").on("slid.bs.carousel", function(e) {
                $(".media-slider").css('width', '100%');
            });*/
        });
    </script>

    <!--subscribers-->
    <script type="text/javascript">
        var subscribersSiteId = 'cd602984-8642-4484-8a8b-431d84a5faf0';
    </script>
    <script type="text/javascript" src="https://cdn.subscribers.com/assets/subscribers.js"></script>

    <!--google analytics-->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-128937544-1', 'auto');
        ga('send', 'pageview');
    </script>

    <!--chat de soporte-->
    <!--Para que se dragable pero que no muestre el chat al finalizar el drag-->
    <script>
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
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!--fin Para que se dragable pero que no muestre el chat al finalizar el drag-->

    <script type='text/javascript' data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: '1e110dc0-e024-4b2b-a871-4e07f3dec0d3', f: true }); done = true; } }; })();</script>
    <!--fin chat de soporte-->

@endsection
