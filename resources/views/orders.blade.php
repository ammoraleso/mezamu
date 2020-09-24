@extends('layouts.app')

@section('page_title')
    {{ "MeZamÜ | Orders" }}
@endsection


@push('stylesAndScripts')
    <script src="{{asset('js/order.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/cart.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
    <link rel="stylesheet" href="{{asset('css/orders.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
    </script>
@endpush

@section('content')
    <form id="myForm" method="GET" action="{{ route('orders') }}" onsubmit="return loadOrders()">
        <div class="input-group search-box">
            
                <label style="margin-top: auto;" class="control-label">{{__('general.Date')}}
                    <!--<small>({{__('general.required')}})</small>-->
                </label>
                <input style="margin-left: 5%;" id="dateInput" class="modal-input" type="date" placeholder="Search.." name="dateInput">
                <button style="width: auto;" class="modal-button" type="submit"><i class="fa fa-search"></i></button>
        </div>

        <hr>
        <div id="ordersList">
            <div>
                @if(isset($orders) && count($orders))
                    
                    <input class="fa fa-search" type="text" id="myInput" onkeyup="myFunction('myInput',0)" placeholder="Buscar Registro.." title="Type in a name">
                    
                    <table id="myTable">
                        <tr class="header">
                            <th style="width:auto;">Orden</th>
                            <th style="width:28%;">Items</th>
                            <th style="width:auto;">Tipo</th>
                            <th style="width:15%;">Cliente</th>
                            <th style="width:auto;">Teléfono</th>
                            <th style="width:20%;">Lugar</th>
                            <th style="width:20%;">Anotaciones</th>
                            <th style="width:auto;">Total</th>
                            <th style="width:20%;">Fecha Creación</th>
                        </tr>
                    
                        @foreach ($orders as $order)
                    
                            <tr>
                                <td>{{$order['order']->id}}</td>
                                <td>
                                    @foreach ($order['items'] as $item)
                                        <p>{{$item->quantity." | ".$item->dishBranch->dish->name}}</p>
                                    @endforeach
                                </td>
                                <td>{{$order['order']->type}}</td>
                                @if($order['order']->customer_id)
                                    <td>{{$order['order']->customer->nombre}}</td>
                                    <td>{{$order['order']->customer->telefono}}</td>
                                @else 
                                    <td>-</td>
                                    <td>-</td>
                                @endif
                                <td>{{$order['order']->place}}</td>
                                <td>{{$order['order']->annotations}}</td>
                                <td>${{number_format($order['order']->total, 0, '.', ',')}}</td>
                                <td>{{$order['order']->date}}</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p>No hay ordenes para mostrar</p>
                @endif
            </div>
        </div>
        

        <div id="back" class="pt-3"style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
            <a class="btn btn-danger" href="{{ url('/') }}">Volver</a>
        </div>
    </form>
   
@endsection
