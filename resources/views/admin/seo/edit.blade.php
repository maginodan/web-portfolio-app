@extends('layouts.admin.base')

@section('content')

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">SEO Settings</h1>
        </div>
    </div>

    @include('includes.flash_message')

    <form
        method="POST"
        action="{{ route('admin.seo.update') }}"
        enctype="multipart/form-data"
        role="form"
    >
        @csrf
        @method('PATCH')

        <div class="row">

            {{-- Meta Tags --}}
            <div class="col-lg-8">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-search"></i> Meta Tags
                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label>Meta Title</label>
                            <input
                                type="text"
                                name="meta_title"
                                class="form-control"
                                placeholder="e.g. Magino Daniel — Full-Stack Web Developer"
                                value="{{ old('meta_title', $seo->meta_title) }}"
                                maxlength="255"
                            >
                            {!! $errors->first('meta_title','<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea
                                name="meta_description"
                                class="form-control"
                                rows="3"
                                placeholder="Shown in Google search results, keep under 160 characters"
                                maxlength="500"
                            >{{ old('meta_description', $seo->meta_description) }}</textarea>
                            {!! $errors->first('meta_description','<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <input
                                type="text"
                                name="meta_keywords"
                                class="form-control"
                                placeholder="web developer, laravel, portfolio"
                                value="{{ old('meta_keywords', $seo->meta_keywords) }}"
                                maxlength="255"
                            >
                            <small class="text-muted">Comma-separated. Rarely used by modern search engines but harmless to include.</small>
                            {!! $errors->first('meta_keywords','<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            <label>Author</label>
                            <input
                                type="text"
                                name="meta_author"
                                class="form-control"
                                placeholder="Magino Daniel"
                                value="{{ old('meta_author', $seo->meta_author) }}"
                                maxlength="255"
                            >
                            {!! $errors->first('meta_author','<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            <label>Twitter Handle</label>
                            <input
                                type="text"
                                name="twitter_handle"
                                class="form-control"
                                placeholder="@yourhandle"
                                value="{{ old('twitter_handle', $seo->twitter_handle) }}"
                                maxlength="255"
                            >
                            {!! $errors->first('twitter_handle','<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label>Canonical URL</label>
                            <input
                                type="url"
                                name="canonical_url"
                                class="form-control"
                                placeholder="https://yourdomain.com"
                                value="{{ old('canonical_url', $seo->canonical_url) }}"
                                maxlength="255"
                            >
                            {!! $errors->first('canonical_url','<p class="text-danger">:message</p>') !!}
                        </div>

                    </div>
                </div>

            </div>

            {{-- Social Share Image --}}
            <div class="col-lg-4">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-image" style="color:green"></i> Social Share Image (OG Image)
                    </div>

                    <div class="panel-body text-center">

                        <img
                            src="{{ $seo->og_image ? asset('uploads/settings/'.$seo->og_image) : asset('uploads/logo-placeholder.png') }}"
                            alt="OG Image"
                            id="ogImage-preview"
                            style="
                                max-width:100%;
                                height:150px;
                                object-fit:cover;
                                background:#f8f8f8;
                                border:3px solid #f0f0f0;
                                border-radius:4px;
                                margin-bottom:15px;
                                padding:5px;
                            "
                        >

                        <br>

                        <input
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            type="file"
                            class="form-control"
                            name="og_image"
                            onchange="showImagePreview(event, 'ogImage-preview')"
                        >

                        <small class="text-muted" style="display:block; margin-top:8px;">
                            Recommended: 1200×630px. Shown when your site is shared on social media.
                        </small>

                        {!! $errors->first('og_image','<p class="text-danger">:message</p>') !!}

                    </div>
                </div>

            </div>

        </div>

        <div class="panel panel-default" style="margin-top:0;">
            <div class="panel-body" style="padding:12px 15px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Save SEO Settings
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