@extends('layouts.template')

@section('title', 'Login - '.config('app.name'))

@section('content')
    <aside class="container login-container">
        <section class="col-md-6 col-md-offset-3">
            <div class="panel panel-collapse panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title"> Login {{ config('app.name') }}</h2>
                </div>
                <div class="panel-body">
                    @if ($errors->has('message'))
                        <div class="alert alert-{{ $errors->has('error') ? 'error': 'success' }} alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ $errors->first('message') }}
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('nip') ? 'has-error' : '' }}">
                            <label class="control-label col-md-4" for="username">NIP</label>
                            <div class="col-md-8">
                                <input class="form-control" name="nip" id="nip" value="{{ old('nip') }}">
                                @if ($errors->has('nip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password')? 'has-error': '' }}">
                            <label class="control-label col-md-4" for="username">Password</label>
                            <div class="col-md-8">
                                <input class="form-control" type="password" name="password" id="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </aside>
@endsection