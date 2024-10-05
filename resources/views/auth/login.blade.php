@extends('auth.layouts.master')
@section('content')
    <section class="login__section">
        <div class="container-fluid"> 
            <div class="row w-100">
                <div class="card col-lg-8 col-md-8 d-flex align-items-center justify-content-center m-auto">
                    <div class="p-4 "> 
                        <div class="login__content text-center">
                            <h2 class="title"><span>Login </span> & Start With To-Do</h2>
                            <p class="desc">Login To-Do List App</p>
                        </div>
                        <div class="form__wrapper w-100">
                            <form class="loginForm" method="POST" action="{{ route('login.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Your Email Address" />
                                    @if ($errors->has('email'))
                                        <div class="alert__txt"><i class="fa-solid fa-circle-info"></i>{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" />
                                    <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                    <div id="password-error" class="alert__txt"></div>
                                    @if ($errors->has('password'))
                                        <div class="alert__txt"><i class="fa-solid fa-circle-info"></i>{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="btn__submit">
                                    <button type="submit" class="btn btn-danger">Login</button>
                                </div>
                                <p class="account text-start mt-2">
                                    Already have an account?
                                    <a href="{{ route('register') }}">Sign up</a>
                                    instead
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
