@extends('layouts.app')

@section('page_title')
    {{ "MeZamÜ | Orders" }}
@endsection


@push('stylesAndScripts')
    <script src="{{ Vite::asset('resources/js/order.js')}}" type="text/javascript"></script>
    <script src="{{ Vite::asset('resources/js/menu.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/cart.css')}}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/orders.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
        var udpateDishStatusUrl = '{{ route('udpateDishStatus') }}';
        var udpateDishUrl = '{{ route('udpateDish') }}';
    </script>
@endpush

@section('content')

    @include('modalDetailsAdminMenu')

    <div id="back" class="pt-3"style="justify-content: center; display: flex; padding-bottom: 1%;">
        <h3><strong>{{$branch->restaurant->name}} - {{$branch->location}}</strong><h3>
    </div>
    <form id="myForm" method="GET" action="{{ route('orders') }}" onsubmit="return loadOrders()">
        <input class="fa fa-search" type="text" id="myInput" onkeyup="myFunction('myInput',0)" placeholder="Buscar Registro.." title="Type in a name">
        <div id="ordersList">
            <div>
                <table id="myTable">
                    <tr class="header">
                        <th style="width:auto;">Plato</th>
                        <th style="width:auto;">Categoria</th>
                        <th style="width:auto;">Precio</th>
                        <th style="width:auto;">Acción</th>
                    </tr>

                    @foreach ($branchDishes as $branchDish)
                        @php
                            $dish = $branchDish->dish;
                        @endphp
                        <tr>
                            <td> <p style="color: #2196f3; text-decoration:underline;"type="button" onclick="showDetailsDishAdmin({{$dish}});">{{$dish->name}} <p></td>
                            <td>{{$dish->category->description}}</td>
                            <td>${{number_format($dish->price, 0, '.', ',')}}</td>
                            <td>
                            <div id="statusButton{{$branchDish->id}}" class="pt-3"style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
                                    @if($branchDish->disable)
                                        <a class="btn btn-success" style="color: white" onclick="changeStatusDish({{$branchDish->id}},0);">Habilitar</a>
                                    @else
                                        <a class="btn btn-danger" style="color: white" onclick="changeStatusDish({{$branchDish->id}},1);">Deshabilitar</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>


        <div id="back" class="pt-3"style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
            <a class="btn btn-danger" href="{{ url('/') }}">Volver</a>
        </div>
    </form>

@endsection
