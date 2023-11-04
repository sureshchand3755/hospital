<?php $page="login";?>
@extends('layout.mainlayout_page')
@section('content')
<div class="main-wrapper login-body">
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-lg-6 login-wrap">
                <div class="login-sec">
                    <div class="log-img">
                        <img class="img-fluid" src="{{URL::to('public/assets/img/login-02.png')}}" alt="Logo">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 login-wrap-bg">
                <div class="login-wrapper">
                    <div class="loginbox">
                        <div class="login-right">
                            <div class="login-right-wrap">
                                <div class="account-logo">
                                    <a href="{{ url('/') }}"><img src="assets/img/login-logo.png" alt=""></a>
                                </div>
                                <h2>Login</h2>
                                @if(Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                    @php
                                        Session::forget('error');
                                    @endphp
                                </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <!-- Form -->
                                {{-- <x-input-error :messages="$errors->get('email')" class="mt-2  text-danger" /> --}}
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label >Email <span class="login-danger">*</span></label>
                                        <input id="email" class="form-control" type="email" name="email" autofocus>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @endif
                                        {{-- <x-input-error :messages="$errors->get('email')" class="mt-2  text-dange" /> --}}
                                    </div>
                                    <div class="form-group">
                                        <label >Password <span class="login-danger">*</span></label>
                                        <input class="form-control pass-input" id="password"
                                        type="password" name="password">
                                        <span class="profile-views feather-eye-off toggle-password"></span>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                        {{-- <x-input-error :messages="$errors->get('email')" class="mt-2  text-dange" /> --}}
                                    </div>
                                    <div class="forgotpass">
                                        <div class="remember-me">
                                            <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
                                            <input id="remember_me" type="checkbox" name="remember">
                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        {{-- <a href="forgot-password.html">Forgot Password?</a> --}}
                                    </div>
                                    <div class="form-group login-btn">
                                        <button class="btn btn-primary btn-block" type="submit">Login</button>
                                    </div>
                                </form>
                                <!-- /Form -->

                                <div class="next-sign">
                                    {{-- <p class="account-subtitle">Need an account?  <a href="{{url('register')}}">Sign Up</a></p> --}}

                                    <!-- Social Login -->
                                    {{-- <div class="social-login">
                                        <a href="javascript:;" ><img src="assets/img/icons/login-icon-01.svg" alt=""></a>
                                        <a href="javascript:;" ><img src="assets/img/icons/login-icon-02.svg" alt=""></a>
                                        <a href="javascript:;" ><img src="assets/img/icons/login-icon-03.svg" alt=""></a>
                                    </div> --}}
                                    <!-- /Social Login -->

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@component('components.sidebar')
@endcomponent>
@endsection
