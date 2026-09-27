@extends('layouts.auth.base') 
@section('title', 'Portfolio - Login')
@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- LEFT SIDE -->
        <div class="col-md-6 hidden-xs hidden-sm" style="background: #337ab7; min-height: 100vh; color: #fff; display: flex; align-items: center;">
            <div class="row" style="width: 100%;">
                <div class="col-md-10 col-md-offset-1">
                    <div style="padding: 40px 0;">
                        <!-- Logo -->
                        <div class="text-center">
                            <img
                                src="{{ asset('uploads/settings/' . ($siteSetting->logo_dark ?? 'logo.png')) }}"
                                alt="Portfolio Logo"
                                style="max-width: 160px; max-height: 90px"
                            />
                        </div>

                        <h1 class="text-center" style="margin-top: 20px;">Welcome Back!</h1>

                        <p class="text-center lead">Manage your portfolio from one powerful dashboard.</p>

                        <hr style="margin: 20px 0;" />

                        <!-- Features -->
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <i class="fa fa-folder-open fa-3x"></i>

                                <h4>Projects</h4>

                                <p>Manage and showcase your work.</p>
                            </div>

                            <div class="col-sm-4 text-center">
                                <i class="fa fa-cogs fa-3x"></i>

                                <h4>Skills</h4>

                                <p>Keep your professional skills updated.</p>
                            </div>

                            <div class="col-sm-4 text-center">
                                <i class="fa fa-envelope fa-3x"></i>

                                <h4>Messages</h4>

                                <p>Keep track of your visitors.</p>
                            </div>
                        </div>

                        <hr style="margin: 20px 0;" />

                        <div class="text-center">
                            <a href="{{ route('pages.index') }}" class="btn btn-default">
                                <i class="fa fa-arrow-left"></i>
                                Go to Portfolio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="col-md-6" style="min-height: 100vh; display: flex; align-items: center;">
            <div class="row" style="width: 100%;">
                <div class="col-md-8 col-md-offset-2">
                    <div style="padding: 30px 0;">
                        <!-- Login Header -->
                        <div class="text-center">
                            <i class="fa fa-unlock-alt fa-4x text-primary"></i>
                            <h2>Sign in</h2>

                            <p class="text-muted">Welcome back! Please sign in to continue.</p>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('authenticate') }}" style="margin-top: 20px;">
                            @csrf

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">
                                    <i class="fa fa-envelope-o fa-fw"></i>
                                    Email Address
                                </label>

                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    class="form-control input-lg"
                                    value="{{ old('email') }}"
                                    placeholder="Email address"
                                    autocomplete="email"
                                    required
                                    autofocus
                                />
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">
                                    <i class="fa fa-lock fa-fw"></i>
                                    Password
                                </label>

                                @error('password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <div style="position: relative">
                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        class="form-control input-lg"
                                        placeholder="Password"
                                        autocomplete="current-password"
                                        required
                                        style="padding-right: 50px"
                                    />

                                    <button
                                        type="button"
                                        id="togglePassword"
                                        aria-label="Show password"
                                        style="
                                            position: absolute;
                                            right: 10px;
                                            top: 50%;
                                            transform: translateY(-50%);
                                            border: none;
                                            background: transparent;
                                            color: #777;
                                            font-size: 18px;
                                            cursor: pointer;
                                            padding: 5px 8px;
                                        "
                                    >
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <script>
                                document.getElementById("togglePassword").addEventListener("click", function () {
                                    const password = document.getElementById("password");
                                    const icon = this.querySelector("i");

                                    if (password.type === "password") {
                                        password.type = "text";

                                        icon.classList.remove("fa-eye");
                                        icon.classList.add("fa-eye-slash");

                                        this.setAttribute("aria-label", "Hide password");
                                    } else {
                                        password.type = "password";

                                        icon.classList.remove("fa-eye-slash");
                                        icon.classList.add("fa-eye");

                                        this.setAttribute("aria-label", "Show password");
                                    }
                                });
                            </script>

                            <!-- hCaptcha -->
                            <!-- hCaptcha -->
                            @if($siteSetting?->hcaptcha_enabled && $siteSetting?->hcaptcha_site_key)
                                <div class="form-group" style="transform: scale(0.92); transform-origin: left top; margin-bottom: 0;">
                                    <div class="h-captcha" data-sitekey="{{ $siteSetting->hcaptcha_site_key }}"></div>
                                    @error('h-captcha-response')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
                            @endif
                            

                            <!-- Remember -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-xs-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" value="1" />
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                                </div>
                            </div>

                            <!-- Login Button -->
                            <button type="submit" id="loginBtn" class="btn btn-primary btn-lg btn-block">
                                <i class="fa fa-sign-in fa-fw" id="loginIcon"></i>
                                <i class="fa fa-spinner fa-spin fa-fw hidden" id="loginSpinner"></i>
                                <span id="loginBtnText">Login</span>
                            </button>
                        </form>

                        <div class="text-center" style="margin-top: 20px;">
                            <hr style="margin: 15px 0;" />

                            <p class="text-muted" style="margin-bottom: 5px;">Portfolio Administration</p>

                            <small class="text-muted"> {{ $siteSetting->footer_text ?? 'Copyright © 2026 Magino Kent Daniel. All rights reserved.' }} </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.querySelector('form[action="{{ route('authenticate') }}"]').addEventListener('submit', function () {
    var btn = document.getElementById('loginBtn');
    var icon = document.getElementById('loginIcon');
    var spinner = document.getElementById('loginSpinner');
    var text = document.getElementById('loginBtnText');

    icon.classList.add('hidden');
    spinner.classList.remove('hidden');
    text.textContent = 'Signing in...';

    // disable on the next tick so the form still submits normally
    setTimeout(function () {
        btn.disabled = true;
    }, 0);
});

// reset the button if the user comes back via the browser's back button
window.addEventListener('pageshow', function () {
    var btn = document.getElementById('loginBtn');
    var icon = document.getElementById('loginIcon');
    var spinner = document.getElementById('loginSpinner');
    var text = document.getElementById('loginBtnText');

    btn.disabled = false;
    icon.classList.remove('hidden');
    spinner.classList.add('hidden');
    text.textContent = 'Login';
});
</script>

@endsection