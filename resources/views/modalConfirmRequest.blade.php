<!-- Modal go to cart-->
<div class="modal fade" id="modalTableToken" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-auto text-center" id="exampleModalLongTitle">{{__('Ask code')}}</h5>
                <button type="button" class="close m-0 p-0 modal-close-button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-auto">
                <div id="reader"></div>
            </div>
        </div>
    </div>
</div>
@push('finalScripts')
    <script src="{{ Vite::asset('resources/js/html5-qrcode.min.js')}}" type="text/javascript"></script>
    <script src="{{ Vite::asset('resources/js/qrreader.js')}}" type="text/javascript"></script>
@endpush
