@extends('layouts.admin.base')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Certificate</h1>
        </div>
    </div>

    @include('includes.flash_message')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">

                <div class="panel-heading">
                    Certificate Details
                </div>

                <div class="panel-body">

                    <form method="POST" action="{{ route('admin.certificates.update', $certificate->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-8">

                                <div class="form-group">
                                    <label>Title</label>

                                    @if ($errors->has('title'))
                                        <p class="text-danger">{{ $errors->first('title') }}</p>
                                    @endif

                                    <input
                                        type="text"
                                        name="title"
                                        class="form-control"
                                        value="{{ old('title', $certificate->title) }}"
                                        placeholder="Enter Certificate Title"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>

                                    @if ($errors->has('description'))
                                        <p class="text-danger">{{ $errors->first('description') }}</p>
                                    @endif

                                    <textarea
                                        name="description"
                                        class="form-control"
                                        rows="5"
                                        placeholder="Enter Certificate Description"
                                        required>{{ old('description', $certificate->description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Certificate PDF</label>

                                    @if ($errors->has('pdf'))
                                        <p class="text-danger">{{ $errors->first('pdf') }}</p>
                                    @endif

                                    <input
                                        type="file"
                                        name="pdf"
                                        class="form-control"
                                        accept="application/pdf">

                                    @if ($certificate->pdf)
                                        <p class="help-block">
                                            <a href="{{ asset('uploads/certificates/' . $certificate->pdf) }}" target="_blank">
                                                <i class="fa fa-file-pdf-o"></i> View Current PDF
                                            </a>
                                        </p>
                                    @endif
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Image</label>

                                    @if ($errors->has('image'))
                                        <p class="text-danger">{{ $errors->first('image') }}</p>
                                    @endif

                                    <div style="margin-bottom:10px;">
                                        <img
                                            src="{{ $certificate->image ? asset('uploads/images/' . $certificate->image) : asset('uploads/images/no-image.png') }}"
                                            alt="{{ $certificate->title }}"
                                            class="img-thumbnail"
                                            id="edit-file-preview-image"
                                            style="max-width:150px; height:100px; object-fit:cover;">
                                    </div>

                                    <input
                                        type="file"
                                        name="image"
                                        class="form-control"
                                        accept="image/*"
                                        onchange="showEditImageFile(event)">
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top:20px;">
                            <a href="{{ route('admin.certificates.index') }}" class="btn btn-default">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function showEditImageFile(event) {
        var input = event.target;

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('edit-file-preview-image').src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush