@extends('layouts.app')
@section('title', 'Register')

@section('content')


<div class="grup-regis-all">
    <h1>Setting</h1>
    <div class="width-content">
        <form  method="POST" enctype="multipart/form-data" action="/Setting-edit/{{$user->id}}">
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="{{ old('username') ? old('username') : $user->username  }}">
                @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ? old('name') : $user->name  }}">
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                <label for="name">Image</label>
                <input type="file" style="font-size: inherit;" class="form-control" name="image" id="image" value="{{ old('image') ? old('image') : $user->image  }}">
                @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat" value="{{ old('alamat') ? old('alamat') : $data->alamat  }}">
                @if ($errors->has('alamat'))
                <span class="help-block">
                    <strong>{{ $errors->first('alamat') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('nohp') ? ' has-error' : '' }}">
                <label for="nohp">No hp</label>
                <input type="text" class="form-control" name="nohp" id="nohp" value="{{ old('nohp') ? old('nohp') : $data->nohp  }}">
                @if ($errors->has('nohp'))
                <span class="help-block">
                    <strong>{{ $errors->first('nohp') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ old('email') ? old('email') : $user->email  }}">
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('passwordLama') ? ' has-error' : '' }}">
                <label for="password">password Lama</label>
                <input type="Password" class="form-control" name="passwordLama" id="passwordLama" >
                @if ($errors->has('passwordLama'))
                <span class="help-block">
                    <strong>{{ $errors->first('passwordLama') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('passwordBaru') ? ' has-error' : '' }}">
                <label for="password">password Baru</label>
                <input type="Password" class="form-control" name="passwordBaru" id="passwordBaru" >
                @if ($errors->has('passwordBaru'))
                <span class="help-block">
                    <strong>{{ $errors->first('passwordBaru') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="pass-kon">Konfirmasi Password</label>
                <input type="Password" class="form-control" id="pass-kon" name="passwordKonfirm" >
                 @if ($errors->has('passwordBaru'))
                <span class="help-block">
                    <strong>{{ $errors->first('passwordBaru') }}</strong>
                </span>
                @endif
            </div>
            {{ csrf_field() }}
            <input type="hidden" name="_method"  value="PUT">
            <button>Update</button>
        </form>
    </div>
</div>

@endsection
