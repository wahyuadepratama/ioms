@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-md-6">
        <div style="padding:5%;">
            <div class="panel panel-default">
                <div class="panel-heading">Selamat Datang Anggota HMSI</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="identity" class="col-md-4 control-label">E-Mail or NIM</label>

                            <div class="col-md-6">
                                <input id="identity" type="text" class="form-control" name="identity" value="{{ old('identity') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('nim'))
                                    <span class="help-block">
                                        <small>{{ $errors->first('nim') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-warning">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>

    </div>
</div>
@endsection
