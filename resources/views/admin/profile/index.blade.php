@extends('layouts.admin.base')

@section('content')

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">My Profile</h1>
        </div>
    </div>

    @include('includes.flash_message')

    <form
        method="POST"
        action="{{ route('admin.profile.update') }}"
        enctype="multipart/form-data"
        role="form"
    >
        @csrf
        @method('PATCH')

        <div class="row">

            {{-- Profile Information --}}
            <div class="col-lg-8">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-user"></i> Profile Information
                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label>Full Name</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Enter full name"
                                value="{{ old('name', $user->name) }}"
                            >
                            {!! $errors->first('name','<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Enter email"
                                value="{{ old('email', $user->email) }}"
                            >
                            {!! $errors->first('email','<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label>Bio</label>
                            <textarea
                                class="form-control"
                                rows="4"
                                name="bio"
                                placeholder="Write a short bio..."
                            >{{ old('bio', $user->bio) }}</textarea>
                            {!! $errors->first('bio','<p class="text-danger">:message</p>') !!}
                        </div>

                    </div>
                </div>

            </div>

            {{-- Profile Photo --}}
            <div class="col-lg-4">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-image" style="color:green"></i> Profile Photo
                    </div>

                    <div class="panel-body text-center">

                        <img
                            src="{{ $user->image ? asset('uploads/images/'.$user->image) : asset('uploads/avatar.png') }}"
                            alt="Profile Photo"
                            id="profileImage-preview"
                            style="
                                width:160px;
                                height:160px;
                                object-fit:cover;
                                object-position:center;
                                border-radius:50%;
                                border:3px solid #f0f0f0;
                                margin-bottom:15px;
                            "
                        >

                        <br>

                        <input
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            type="file"
                            class="form-control"
                            name="image"
                            onchange="showProfileImageFile(event)"
                        >

                        {!! $errors->first('image','<p class="text-danger">:message</p>') !!}

                    </div>
                </div>

            </div>

        </div>

        <div class="panel panel-default" style="margin-top:0;">
            <div class="panel-body" style="padding:12px 15px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Save Profile
                </button>
            </div>
        </div>

    </form>

    {{-- Change Password --}}
    <form
        method="POST"
        action="{{ route('admin.profile.password') }}"
        role="form"
    >
        @csrf
        @method('PATCH')

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-lock" style="color:red"></i> Change Password
            </div>

            <div class="panel-body">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input
                                type="password"
                                name="current_password"
                                class="form-control"
                                placeholder="Enter current password"
                            >
                            {!! $errors->first('current_password','<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>New Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Enter new password"
                            >
                            {!! $errors->first('password','<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Confirm new password"
                            >
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-key"></i> Update Password
                </button>

            </div>
        </div>

    </form>

</div>

<script>
function showProfileImageFile(event) {
    var input = event.target;

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function() {
            document.getElementById('profileImage-preview').src = reader.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection