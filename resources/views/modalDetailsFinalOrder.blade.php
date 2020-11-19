<div class="modal fade" id="modalDetailsFinalOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-auto text-center modal-header" id="header-tittle">Detalle de Orden</h5>
                <button type="button" class="close m-0 p-0 modal-close-button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="orderTable">
                <table>
                    <tr>
                        <th class="no-align"><h5><strong>{{__('general.Products')}} ({{$finaltotalQuantity}})</strong></h5></th>
                        <th><h5><strong>{{__('general.Quantity')}}</strong></h5></th>
                        <th><h5><strong>{{__('general.Cost')}}</strong></h5></th>
                    </tr>
                    @foreach(Session::get('finalOrder') as $itemOrder)
                        @if(data_get($itemOrder, 'item'))
                            @php
                                $itemComplete = data_get($itemOrder, 'item');
                                $itemQuantity = data_get($itemOrder, 'quantity');
                                $itemPrice = $itemComplete->dish['price'];
                                if($itemComplete->promotion)
                                {
                                    $itemPrice = $itemComplete->discountPrice();
                                }
                            @endphp
                            <tr>
                                <td class="no-align">{{$itemComplete->dish['name']}}</td>
                                <td>X {{$itemQuantity}}</td>
                                <td>$ {{number_format($itemPrice, 0, '.', ',')}}</td>
                            </tr>
                        @endif
                    @endforeach
                    @if ($deliveryPrice)
                        <tr>
                            <td class="no-align">{{__('general.Delivery')}}</td>
                            <td>-</td>
                            <td>$ {{number_format($deliveryPrice, 0, '.', ',')}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td></td>
                        <td><h4><strong>{{__('general.Total')}}</strong></h4></td>
                        <td><h4 id="totalPriceTable"><strong>$ {{number_format($finalPrice, 0, '.', ',')}}</strong></h4></td>
                    </tr>
                </table>
            </div>
            <div id="back" class="pt-3"style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
                <button onclick="generatePDF();" class="btn btn-success">Crear PDF</button>
            </div>
        </div>
    </div>
</div>




