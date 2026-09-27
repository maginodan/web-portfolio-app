@extends('layouts.auth.base')
@section('title', 'Portfolio - Reset Password')
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

                        <h1 class="text-center">Almost There!</h1>

                        <p class="text-center lead">Set a new password to get back into your dashboard.</p>

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
                            <i class="fa fa-lock fa-4x text-primary"></i>
                            <h2>Reset Password</h2>

                            <p class="text-muted">Enter your new password below.</p>
                        </div>

                        <br />

                        <!-- Reset Password Form -->
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

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
                                    value="{{ old('email', $email) }}"
                                    placeholder="Email address"
                                    autocomplete="email"
                                    required
                                    autofocus
                                />
                            </div>

                            <!-- New Password -->
                            <div class="form-group">
                                <label for="password">
                                    <i class="fa fa-lock fa-fw"></i>
                                    New Password
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
                                        placeholder="New password"
                                        autocomplete="new-password"
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

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label for="password_confirmation">
                                    <i class="fa fa-lock fa-fw"></i>
                                    Confirm New Password
                                </label>

                                <div style="position: relative">
                                    <input
                                        id="password_confirmation"
                                        type="password"
                                        name="password_confirmation"
                                        class="form-control input-lg"
                                        placeholder="Confirm new password"
                                        autocomplete="new-password"
                                        required
                                        style="padding-right: 50px"
                                    />

                                    <button
                                        type="button"
                                        id="toggleConfirmPassword"
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
                                function bindToggle(buttonId, inputId) {
                                    document.getElementById(buttonId).addEventListener("click", function () {
                                        const input = document.getElementById(inputId);
                                        const icon = this.querySelector("i");

                                        if (input.type === "password") {
                                            input.type = "text";
                                            icon.classList.remove("fa-eye");
                                            icon.classList.add("fa-eye-slash");
                                            this.setAttribute("aria-label", "Hide password");
                                        } else {
                                            input.type = "password";
                                            icon.classList.remove("fa-eye-slash");
                                            icon.classList.add("fa-eye");
                                            this.setAttribute("aria-label", "Show password");
                                        }
                                    });
                                }

                                bindToggle("togglePassword", "password");
                                bindToggle("toggleConfirmPassword", "password_confirmation");
                            </script>

                            <!-- Reset Button -->
                            <button type="submit" id="resetBtn" class="btn btn-primary btn-lg btn-block">
                                <i class="fa fa-check fa-fw" id="resetIcon"></i>
                                <i class="fa fa-spinner fa-spin fa-fw hidden" id="resetSpinner"></i>
                                <span id="resetBtnText">Reset Password</span>
                            </button>
                        </form>

                        <br />

                        <div class="text-center">
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
document.querySelector('form[action="{{ route('password.update') }}"]').addEventListener('submit', function () {
    var btn = document.getElementById('resetBtn');
    var icon = document.getElementById('resetIcon');
    var spinner = document.getElementById('resetSpinner');
    var text = document.getElementById('resetBtnText');

    icon.classList.add('hidden');
    spinner.classList.remove('hidden');
    text.textContent = 'Resetting...';

    setTimeout(function () {
        btn.disabled = true;
    }, 0);
});
</script>

@endsection