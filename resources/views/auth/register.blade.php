@extends('layouts.app')
@section('title', 'Register')

@section('content')


<div class="grup-regis-all">
    <h1>Registrasi</h1>
    <div class="width-content">
        <form  method="POST" action="{{ route('register') }}">
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username">
                @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name">
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email">
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password</label>
                <input type="Password" class="form-control" name="password" id="password" required>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="pass-kon">Konfirmasi Password</label>
                <input type="Password" class="form-control" id="pass-kon" name="password_confirmation" required>
            </div>
            {{ csrf_field() }}
            <button>Register</button>
        </form>
    </div>
</div>

@endsection
