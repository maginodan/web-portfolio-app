<div
    class="modal fade"
    id="createModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="createModalLabel">

    <div class="modal-dialog" role="document">

        <form
            method="POST"
            action="{{ route('admin.testimonials.store') }}"
            enctype="multipart/form-data">

            @csrf

            <div class="modal-content">

                <div class="modal-header">
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">
                        &times;
                    </button>

                    <h4 class="modal-title" id="createModalLabel">
                        Add New Testimonial
                    </h4>
                </div>

                <div class="modal-body">

                    <!-- Photo -->
                    <div class="form-group">
                        <label>Photo</label>

                        @if ($errors->has('image'))
                            <p class="text-danger">
                                {{ $errors->first('image') }}
                            </p>
                        @endif

                        <div style="margin-bottom:10px;">
                            <img
                                src="{{ asset('uploads/avatar.png') }}"
                                alt="Photo Preview"
                                class="img-thumbnail"
                                id="create-file-preview-image"
                                style="width:100px; height:100px; object-fit:cover;">
                        </div>

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept="image/*"
                            onchange="showCreateImageFile(event)">
                    </div>

                    <!-- Name -->
                    <div class="form-group">
                        <label>Name</label>

                        @if ($errors->has('name'))
                            <p class="text-danger">
                                {{ $errors->first('name') }}
                            </p>
                        @endif

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            placeholder="Enter Name"
                            required>
                    </div>

                    <!-- Function -->
                    <div class="form-group">
                        <label>Function</label>

                        @if ($errors->has('function'))
                            <p class="text-danger">
                                {{ $errors->first('function') }}
                            </p>
                        @endif

                        <input
                            type="text"
                            name="function"
                            class="form-control"
                            value="{{ old('function') }}"
                            placeholder="Enter Function"
                            required>
                    </div>

                    <!-- Testimony -->
                    <div class="form-group">
                        <label>Testimony</label>

                        @if ($errors->has('testimony'))
                            <p class="text-danger">
                                {{ $errors->first('testimony') }}
                            </p>
                        @endif

                        <textarea
                            name="testimony"
                            class="form-control"
                            rows="5"
                            placeholder="Enter Testimonial"
                            required>{{ old('testimony') }}</textarea>
                    </div>

                    <!-- Rating -->
                    <div class="form-group">
                        <label>Rating (out of 5)</label>

                        @if ($errors->has('rating'))
                            <p class="text-danger">
                                {{ $errors->first('rating') }}
                            </p>
                        @endif

                        <input
                            type="number"
                            name="rating"
                            class="form-control"
                            value="{{ old('rating') }}"
                            min="1"
                            max="5"
                            placeholder="5"
                            required>
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-default"
                        data-dismiss="modal">
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="btn btn-success">
                        <i class="fa fa-save"></i>
                        Save
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>

<script>
    function showCreateImageFile(event) {
        var input = event.target;

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('create-file-preview-image').src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>