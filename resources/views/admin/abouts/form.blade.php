@include('includes.flash_message')

<form
    method="POST"
    action="{{ route('abouts.update', $about->id) }}"
    enctype="multipart/form-data"
    role="form"
>
    @csrf
    @method('PATCH')

    <div class="row">

        {{-- Personal Information --}}
        <div class="col-lg-8">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user"></i> Personal Information
                </div>

                <div class="panel-body">

                    <div class="form-group">
                        <label>Full Name</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Enter full name"
                            value="{{ old('name', $about->name ?? '') }}"
                        >
                        {!! $errors->first('name','<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <label>Greeting</label>
                        <input
                            type="text"
                            name="greeting"
                            class="form-control"
                            placeholder="e.g. Hi, I'm"
                            value="{{ old('greeting', $about->greeting ?? '') }}"
                        >
                        <small class="text-muted">The opening phrase before your name in the hero heading.</small>
                        {!! $errors->first('greeting','<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <label>Role / Job Title</label>
                        <input
                            type="text"
                            name="role"
                            class="form-control"
                            placeholder="e.g. Full-Stack Web Developer"
                            value="{{ old('role', $about->role ?? '') }}"
                        >
                        <small class="text-muted">Shown in the hero heading, e.g. "Hi, I'm {{ $about->name ?? 'Name' }} — <strong>Full-Stack</strong> Web Developer"</small>
                        {!! $errors->first('role','<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Enter email"
                            value="{{ old('email', $about->email ?? '') }}"
                        >
                        {!! $errors->first('email','<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            placeholder="Enter phone number"
                            value="{{ old('phone', $about->phone ?? '') }}"
                        >
                        {!! $errors->first('phone','<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input
                            type="text"
                            name="address"
                            class="form-control"
                            placeholder="Enter address"
                            value="{{ old('address', $about->address ?? '') }}"
                        >
                        {!! $errors->first('address','<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea
                            class="form-control"
                            rows="3"
                            name="description"
                            placeholder="Write something about yourself..."
                        >{{ old('description', $about->description ?? '') }}</textarea>
                        {!! $errors->first('description','<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <label>Summary</label>
                        <textarea
                            class="form-control"
                            rows="2"
                            name="summary"
                            placeholder="Write a short summary..."
                        >{{ old('summary', $about->summary ?? '') }}</textarea>
                        {!! $errors->first('summary','<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group">
                        <label>Tagline</label>
                        <input
                            type="text"
                            name="tagline"
                            class="form-control"
                            placeholder="Enter your tagline"
                            value="{{ old('tagline', $about->tagline ?? '') }}"
                        >
                        {!! $errors->first('tagline','<p class="text-danger">:message</p>') !!}
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label>Availability Status</label>
                        <input
                            type="text"
                            name="availability_text"
                            class="form-control"
                            placeholder="e.g. Available for new projects"
                            value="{{ old('availability_text', $about->availability_text ?? '') }}"
                        >
                        <small class="text-muted">Shown as the small pill badge above the hero heading on your homepage.</small>
                        {!! $errors->first('availability_text','<p class="text-danger">:message</p>') !!}
                    </div>

                </div>
            </div>

        </div>

        {{-- Profile Images & CV --}}
        <div class="col-lg-4">

            {{-- Profile Image --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user" style="color:green"></i> Profile Image
                </div>

                <div class="panel-body text-center">

                    <img
                        src="{{ isset($about->home_image) && $about->home_image
                            ? asset('uploads/images/'.$about->home_image)
                            : asset('images/avatar.png') }}"
                        class="img-thumbnail"
                        alt="Profile Image"
                        id="homeImage-preview"
                        style="width:100%; max-height:220px; object-fit:cover; margin-bottom:10px;"
                    >

                    <input
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        type="file"
                        class="form-control"
                        id="fileimg"
                        name="home_image"
                        onchange="showHomeImageFile(event)"
                    >

                    {!! $errors->first('home_image','<p class="text-danger">:message</p>') !!}

                </div>
            </div>

            {{-- Cover Image --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-picture-o" style="color:blue"></i> Cover Image
                </div>

                <div class="panel-body text-center">

                    <img
                        src="{{ isset($about->banner_image) && $about->banner_image
                            ? asset('uploads/images/'.$about->banner_image)
                            : asset('images/avatar.png') }}"
                        class="img-thumbnail"
                        alt="Cover Image"
                        id="bannerImage-preview"
                        style="width:100%; max-height:220px; object-fit:cover; margin-bottom:10px;"
                    >

                    <input
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        type="file"
                        class="form-control"
                        id="bannerimg"
                        name="banner_image"
                        onchange="showBannerImageFile(event)"
                    >

                    {!! $errors->first('banner_image','<p class="text-danger">:message</p>') !!}

                </div>
            </div>

            {{-- CV --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file-pdf-o" style="color:red"></i> Upload CV
                </div>

                <div class="panel-body text-center">

                    @if($about->cv ?? false)
                        <p class="text-muted" style="margin-bottom:6px;">
                            <i class="fa fa-file-pdf-o"></i> Current: <strong id="cv-filename">{{ $about->cv }}</strong>
                        </p>
                        <iframe
                            id="cv-preview"
                            src="{{ asset('uploads/cv/'.$about->cv) }}"
                            style="width:100%; height:220px; border:1px solid #ddd; margin-bottom:10px;"
                        ></iframe>
                        <a href="{{ asset('uploads/cv/'.$about->cv) }}" target="_blank" class="btn btn-default btn-sm" style="margin-bottom:10px;">
                            <i class="fa fa-external-link"></i> Open in new tab
                        </a>
                    @else
                        <div id="cv-preview-empty" class="text-muted" style="padding:40px 0; border:1px dashed #ccc; margin-bottom:10px;">
                            <i class="fa fa-file-pdf-o fa-2x"></i>
                            <p style="margin-top:8px;">No CV uploaded yet</p>
                        </div>
                        <iframe id="cv-preview" style="width:100%; height:220px; border:1px solid #ddd; margin-bottom:10px; display:none;"></iframe>
                    @endif

                    <input
                        accept=".pdf,application/pdf"
                        type="file"
                        class="form-control"
                        id="filecv"
                        name="cv"
                        onchange="showCvFile(event)"
                    >

                    {!! $errors->first('cv','<p class="text-danger">:message</p>') !!}

                </div>
            </div>

        </div>

    </div>

    {{-- Save Changes --}}
    <div class="panel panel-default" style="margin-top:0;">
        <div class="panel-body" style="padding:12px 15px;">

            <button
                type="submit"
                class="btn btn-primary"
            >
                <i class="fa fa-save"></i> Save All Changes
            </button>

            <span class="text-muted" style="margin-left:10px;">
                Make sure all your information is correct before saving.
            </span>

        </div>
    </div>

</form>

<script>
function showHomeImageFile(event) {
    var input = event.target;

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function() {
            document.getElementById('homeImage-preview').src = reader.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function showBannerImageFile(event) {
    var input = event.target;

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function() {
            document.getElementById('bannerImage-preview').src = reader.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function showCvFile(event) {
    var input = event.target;

    if (input.files && input.files[0]) {
        var file = input.files[0];
        var fileURL = URL.createObjectURL(file);

        var preview = document.getElementById('cv-preview');
        preview.src = fileURL;
        preview.style.display = 'block';

        var emptyState = document.getElementById('cv-preview-empty');
        if (emptyState) {
            emptyState.style.display = 'none';
        }

        var filenameEl = document.getElementById('cv-filename');
        if (filenameEl) {
            filenameEl.textContent = file.name;
        }
    }
}
</script>