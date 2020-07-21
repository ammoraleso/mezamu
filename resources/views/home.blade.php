@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a class="active" href="#home">Home</a>
        <a href="#news">News</a>
        <a href="#contact">Contact</a>
        <a href="#about">About</a>
    </div>

    <div id="main">
        <button class="openbtn" onclick="openNav()">&#9776;</button>
    </div>
@endsection
