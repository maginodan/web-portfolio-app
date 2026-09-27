@extends('layouts.admin.base')

@section('content')

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Site Settings</h1>
        </div>
    </div>

    @include('includes.flash_message')

    <form
        method="POST"
        action="{{ route('admin.settings.update') }}"
        enctype="multipart/form-data"
        role="form"
    >
        @csrf
        @method('PATCH')

        <div class="row">

            {{-- General Settings --}}
            <div class="col-lg-8">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-cogs"></i> General Settings
                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label>Footer Text</label>
                            <input
                                type="text"
                                name="footer_text"
                                class="form-control"
                                placeholder="Enter footer text"
                                value="{{ old('footer_text', $setting->footer_text) }}"
                                maxlength="255"
                            >
                            {!! $errors->first('footer_text','<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label>Primary Color</label>
                            <div class="input-group">
                                <input
                                    type="color"
                                    id="primaryColorPicker"
                                    class="form-control"
                                    style="max-width:60px; padding:2px; height:34px;"
                                    value="{{ old('primary_color', $setting->primary_color ?: '#000000') }}"
                                    onchange="document.getElementById('primaryColorText').value = this.value"
                                >
                                <input
                                    type="text"
                                    name="primary_color"
                                    id="primaryColorText"
                                    class="form-control"
                                    placeholder="#000000"
                                    value="{{ old('primary_color', $setting->primary_color) }}"
                                    pattern="^#([A-Fa-f0-9]{6})$"
                                    maxlength="7"
                                    oninput="syncColorPicker(this.value)"
                                >
                            </div>
                            <small class="text-muted">Paste or type a hex code (e.g. #2563eb), or use the swatch.</small>
                            {!! $errors->first('primary_color','<p class="text-danger">:message</p>') !!}
                        </div>

                        <script>
                        function syncColorPicker(value) {
                            if (/^#([A-Fa-f0-9]{6})$/.test(value)) {
                                document.getElementById('primaryColorPicker').value = value;
                            }
                        }
                        </script>

                    </div>
                </div>

                {{-- hCaptcha Settings --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-shield"></i> hCaptcha Settings
                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label>hCaptcha Site Key</label>
                            <input
                                type="text"
                                name="hcaptcha_site_key"
                                class="form-control"
                                placeholder="Enter hCaptcha site key"
                                value="{{ old('hcaptcha_site_key', $setting->hcaptcha_site_key) }}"
                                maxlength="255"
                            >
                            {!! $errors->first('hcaptcha_site_key','<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            <label>hCaptcha Secret Key</label>
                            <input
                                type="text"
                                name="hcaptcha_secret_key"
                                class="form-control"
                                placeholder="Enter hCaptcha secret key"
                                value="{{ old('hcaptcha_secret_key', $setting->hcaptcha_secret_key) }}"
                                maxlength="255"
                            >
                            {!! $errors->first('hcaptcha_secret_key','<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="checkbox" style="margin-bottom:0;">
                            <label>
                                <input
                                    type="checkbox"
                                    name="hcaptcha_enabled"
                                    value="1"
                                    {{ old('hcaptcha_enabled', $setting->hcaptcha_enabled) ? 'checked' : '' }}
                                >
                                Enable hCaptcha on login page
                            </label>
                            {!! $errors->first('hcaptcha_enabled','<p class="text-danger">:message</p>') !!}
                        </div>

                    </div>
                </div>

                {{-- Cookie Consent Settings --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Cookie Consent Banner
                    </div>

                    <div class="panel-body">

                        <div class="checkbox">
                            <label>
                                <input
                                    type="checkbox"
                                    name="cookie_consent_enabled"
                                    value="1"
                                    {{ old('cookie_consent_enabled', $setting->cookie_consent_enabled) ? 'checked' : '' }}
                                >
                                Show cookie consent banner on the site
                            </label>
                            {!! $errors->first('cookie_consent_enabled','<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            <label>Consent Text</label>
                            <textarea
                                name="cookie_consent_text"
                                class="form-control"
                                rows="3"
                                placeholder="e.g. This website uses cookies to enhance your browsing experience."
                            >{{ old('cookie_consent_text', $setting->cookie_consent_text) }}</textarea>
                            {!! $errors->first('cookie_consent_text','<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Accept Button Text</label>
                                    <input
                                        type="text"
                                        name="cookie_accept_text"
                                        class="form-control"
                                        value="{{ old('cookie_accept_text', $setting->cookie_accept_text) }}"
                                        placeholder="Accept all"
                                        maxlength="50"
                                    >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Decline Button Text</label>
                                    <input
                                        type="text"
                                        name="cookie_decline_text"
                                        class="form-control"
                                        value="{{ old('cookie_decline_text', $setting->cookie_decline_text) }}"
                                        placeholder="Necessary only"
                                        maxlength="50"
                                    >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Privacy Link Text</label>
                                    <input
                                        type="text"
                                        name="cookie_privacy_text"
                                        class="form-control"
                                        value="{{ old('cookie_privacy_text', $setting->cookie_privacy_text) }}"
                                        placeholder="Privacy Policy"
                                        maxlength="50"
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label>Privacy Link URL (optional)</label>
                            <input
                                type="text"
                                name="cookie_privacy_url"
                                class="form-control"
                                value="{{ old('cookie_privacy_url', $setting->cookie_privacy_url) }}"
                                placeholder="Leave blank to use the site's default Privacy Policy page"
                            >
                            <small class="text-muted">If left blank, the banner links to your site's built-in Privacy Policy page.</small>
                        </div>

                    </div>
                </div>

            </div>

            {{-- Branding --}}
            <div class="col-lg-4">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-image" style="color:green"></i> Logo (Light)
                    </div>

                    <div class="panel-body text-center">

                        <img
                            src="{{ $setting->logo_light ? asset('uploads/settings/'.$setting->logo_light) : asset('uploads/logo-placeholder.png') }}"
                            alt="Logo Light"
                            id="logoLight-preview"
                            style="
                                max-width:100%;
                                height:100px;
                                object-fit:contain;
                                background:#f8f8f8;
                                border:3px solid #f0f0f0;
                                border-radius:4px;
                                margin-bottom:15px;
                                padding:5px;
                            "
                        >

                        <br>

                        <input
                            accept=".jpg,.jpeg,.png,.svg,.webp,image/jpeg,image/png,image/svg+xml,image/webp"
                            type="file"
                            class="form-control"
                            name="logo_light"
                            onchange="showImagePreview(event, 'logoLight-preview')"
                        >

                        {!! $errors->first('logo_light','<p class="text-danger">:message</p>') !!}

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-image" style="color:#333"></i> Logo (Dark)
                    </div>

                    <div class="panel-body text-center">

                        <img
                            src="{{ $setting->logo_dark ? asset('uploads/settings/'.$setting->logo_dark) : asset('uploads/logo-placeholder.png') }}"
                            alt="Logo Dark"
                            id="logoDark-preview"
                            style="
                                max-width:100%;
                                height:100px;
                                object-fit:contain;
                                background:#333;
                                border:3px solid #f0f0f0;
                                border-radius:4px;
                                margin-bottom:15px;
                                padding:5px;
                            "
                        >

                        <br>

                        <input
                            accept=".jpg,.jpeg,.png,.svg,.webp,image/jpeg,image/png,image/svg+xml,image/webp"
                            type="file"
                            class="form-control"
                            name="logo_dark"
                            onchange="showImagePreview(event, 'logoDark-preview')"
                        >

                        {!! $errors->first('logo_dark','<p class="text-danger">:message</p>') !!}

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-image" style="color:orange"></i> Favicon
                    </div>

                    <div class="panel-body text-center">

                        <img
                            src="{{ $setting->favicon ? asset('uploads/settings/'.$setting->favicon) : asset('uploads/logo-placeholder.png') }}"
                            alt="Favicon"
                            id="favicon-preview"
                            style="
                                width:64px;
                                height:64px;
                                object-fit:contain;
                                background:#f8f8f8;
                                border:3px solid #f0f0f0;
                                border-radius:4px;
                                margin-bottom:15px;
                                padding:5px;
                            "
                        >

                        <br>

                        <input
                            accept=".png,.ico,.svg,image/png,image/x-icon,image/svg+xml"
                            type="file"
                            class="form-control"
                            name="favicon"
                            onchange="showImagePreview(event, 'favicon-preview')"
                        >

                        {!! $errors->first('favicon','<p class="text-danger">:message</p>') !!}

                    </div>
                </div>

            </div>

        </div>

        <div class="panel panel-default" style="margin-top:0;">
            <div class="panel-body" style="padding:12px 15px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Save Settings
                </button>
            </div>
        </div>

    </form>

</div>

<script>
function showImagePreview(event, previewId) {
    var input = event.target;

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function() {
            document.getElementById(previewId).src = reader.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection