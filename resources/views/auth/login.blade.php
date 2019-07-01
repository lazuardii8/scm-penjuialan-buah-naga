@extends('layouts.app')
@section('title', 'Login')

@section('content')

<div class="grup-login-all">
    <h1>Login Lur</h1>
    <div class="width-content">
        <form method="POST" action="{{ route('login') }}">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('Password') ? ' has-error' : '' }}">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            {{ csrf_field() }}
            <button>Login</button>
        </form>
    </div>
</div>


@endsection
