@extends('layouts.auth.base')
@section('title', 'Portfolio - Forgot Password')
@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- LEFT SIDE -->
        <div class="col-md-6 hidden-xs hidden-sm" style="background: #337ab7; min-height: 100vh; color: #fff">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div style="padding-top: 120px">
                        <!-- Logo -->
                        <div class="text-center">
                            <img
                                src="{{ asset('uploads/settings/' . ($siteSetting->logo_dark ?? 'logo.png')) }}"
                                alt="Portfolio Logo"
                                style="max-width: 160px; max-height: 90px"
                            />
                        </div>

                        <br />

                        <h1 class="text-center">Forgot Your Password?</h1>

                        <p class="text-center lead">No worries, we'll send you reset instructions.</p>

                        <hr />

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

                        <hr />

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
        <div class="col-md-6" style="min-height: 100vh">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div style="padding-top: 120px">
                        <!-- Header -->
                        <div class="text-center">
                            <i class="fa fa-key fa-4x text-primary"></i>
                            <h2>Forgot Password</h2>

                            <p class="text-muted">Enter your email and we'll send you a reset link.</p>
                        </div>

                        <br />

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Forgot Password Form -->
                        <form method="POST" action="{{ route('password.email') }}">
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

                            <!-- Send Button -->
                            <button type="submit" id="sendBtn" class="btn btn-primary btn-lg btn-block">
                                <i class="fa fa-paper-plane fa-fw" id="sendIcon"></i>
                                <i class="fa fa-spinner fa-spin fa-fw hidden" id="sendSpinner"></i>
                                <span id="sendBtnText">Send Reset Link</span>
                            </button>
                        </form>

                        <br />

                        <div class="text-center">
                            <a href="{{ route('login') }}">
                                <i class="fa fa-arrow-left"></i> Back to Login
                            </a>

                            <hr />

                            <p class="text-muted">Portfolio Administration</p>

                            <small class="text-muted"> {{ $siteSetting->footer_text ?? 'Copyright © 2026 Magino Kent Daniel. All rights reserved.' }} </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelector('form[action="{{ route('password.email') }}"]').addEventListener('submit', function () {
    var btn = document.getElementById('sendBtn');
    var icon = document.getElementById('sendIcon');
    var spinner = document.getElementById('sendSpinner');
    var text = document.getElementById('sendBtnText');

    icon.classList.add('hidden');
    spinner.classList.remove('hidden');
    text.textContent = 'Sending...';

    setTimeout(function () {
        btn.disabled = true;
    }, 0);
});

window.addEventListener('pageshow', function () {
    var btn = document.getElementById('sendBtn');
    var icon = document.getElementById('sendIcon');
    var spinner = document.getElementById('sendSpinner');
    var text = document.getElementById('sendBtnText');

    btn.disabled = false;
    icon.classList.remove('hidden');
    spinner.classList.add('hidden');
    text.textContent = 'Send Reset Link';
});
</script>

@endsection