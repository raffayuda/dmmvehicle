@extends('layouts.login')


@section('content')


<form method="POST" class="form-horizontal form-material" id="loginform" action="{{ route('login') }}">
    @csrf
    <h3 class="text-center m-b-20">Sign In</h3>
    <div class="form-group ">
        <div class="col-xs-12">

            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>

            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif

        </div>
    </div>

    
    <div class="form-group">
        <div class="col-xs-12">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                name="password" required autocomplete="current-password" placeholder="Password">

            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
    </div>

    

    <div class="form-group text-center">
        <div class="col-xs-12 p-b-20">
            <button type="submit" class="btn btn-block btn-lg btn-info btn-rounded">
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif
        </div>
    </div>
</form>


@endsection