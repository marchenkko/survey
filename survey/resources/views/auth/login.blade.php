@extends('layouts.auth-master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form method="post" action="{{ route('login.perform') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="col-4">
                    <h1 class="h3 mb-3 fw-normal">Login</h1>
                </div>
                @include('layouts.partials.messages')
                <div class="col-4">
                    <label for="floatingName">Email or Username</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}"
                           placeholder="Username" required="required" autofocus>
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>

                <div class="col-4">
                    <label for="floatingPassword">Password</label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                           placeholder="Password" required="required">
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="col-4">
                    <p class="margin-bottom-20"></p>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                </div>
                @include('auth.partials.copy')
            </form>
        </div>
    </div>
@endsection
