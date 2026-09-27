<div
    class="modal fade"
    id="editModal{{ $testimonial->id }}"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editModalLabel{{ $testimonial->id }}">

    <div class="modal-dialog" role="document">

        <form
            method="POST"
            action="{{ route('admin.testimonials.update', $testimonial->id) }}"
            enctype="multipart/form-data">

            @csrf
            @method('PATCH')

            <div class="modal-content">

                <div class="modal-header">
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">
                        &times;
                    </button>

                    <h4
                        class="modal-title"
                        id="editModalLabel{{ $testimonial->id }}">
                        Edit Testimonial
                    </h4>
                </div>

                <div class="modal-body">

                    <!-- Current Photo -->
                    <div class="form-group">
                        <label>Current Photo</label>

                        <div style="margin-top:5px;">
                            @if ($testimonial->image)
                                <img
                                    src="{{ asset('uploads/images/' . $testimonial->image) }}"
                                    alt="{{ $testimonial->name }}"
                                    class="img-thumbnail"
                                    id="edit-file-preview-image-{{ $testimonial->id }}"
                                    style="width:100px; height:100px; object-fit:cover;">
                            @else
                                <img
                                    src="{{ asset('uploads/avatar.png') }}"
                                    alt="No Photo"
                                    class="img-thumbnail"
                                    id="edit-file-preview-image-{{ $testimonial->id }}"
                                    style="width:100px; height:100px; object-fit:cover;">
                            @endif
                        </div>
                    </div>

                    <!-- Change Photo -->
                    <div class="form-group">
                        <label>Change Photo</label>

                        @if ($errors->has('image'))
                            <p class="text-danger">
                                {{ $errors->first('image') }}
                            </p>
                        @endif

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept="image/*"
                            onchange="showEditImageFile(event, {{ $testimonial->id }})">
                    </div>

                    <!-- Name -->
                    <div class="form-group">
                        <label>Name</label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ $testimonial->name }}"
                            placeholder="Enter Name"
                            required>
                    </div>

                    <!-- Function -->
                    <div class="form-group">
                        <label>Function</label>

                        <input
                            type="text"
                            name="function"
                            class="form-control"
                            value="{{ $testimonial->function }}"
                            placeholder="Enter Function"
                            required>
                    </div>

                    <!-- Testimony -->
                    <div class="form-group">
                        <label>Testimony</label>

                        <textarea
                            name="testimony"
                            class="form-control"
                            rows="5"
                            placeholder="Enter Testimonial"
                            required>{{ $testimonial->testimony }}</textarea>
                    </div>

                    <!-- Rating -->
                    <div class="form-group">
                        <label>Rating (out of 5)</label>

                        <input
                            type="number"
                            name="rating"
                            class="form-control"
                            value="{{ $testimonial->rating }}"
                            min="1"
                            max="5"
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
                        class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Update
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>

<script>
    function showEditImageFile(event, testimonialId) {
        var input = event.target;

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('edit-file-preview-image-' + testimonialId).src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>