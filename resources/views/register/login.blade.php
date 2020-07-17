@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">

    <div class="container">
        <div class="row justify-content-center loginDiv">
            <div class="col-md-8">
                <div class="floating-card form "  >
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            <!--el novalidate evita los mensaje de validación del navegador-->
                            @csrf
                            <div class="form-group row">
                                <label for="user" class="col-sm-4 col-form-label text-md-right"><b>{{ __('Usuario') }}</b></label>

                                <div class="col-md-6">
                                    <input id="user" type="text" class="form-control{{ $errors->has('user') ? ' is-invalid' : '' }}" name="user" value="{{ old('user') }}" required autofocus>

                                    @if ($errors->has('user'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"><b>{{ __('Password') }}</b></label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button  type="submit" class="btn button_login" >
                                        {{ __('Iniciar Sesión') }}
                                    </button>

                                    <a class="btn btn-link" href="">
                                        {{ __('Olvidaste Tu Contraseña?') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
