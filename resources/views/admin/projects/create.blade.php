<div
    class="modal fade"
    id="createModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="createModalLabel">

    <div class="modal-dialog" role="document">

        <form
            method="POST"
            action="{{ route('admin.projects.store') }}"
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
                        Add New Project
                    </h4>
                </div>

                <div class="modal-body">

                    <!-- Image -->
                    <div class="form-group">
                        <label>Image</label>

                        @if ($errors->has('image'))
                            <p class="text-danger">
                                {{ $errors->first('image') }}
                            </p>
                        @endif

                        <div style="margin-bottom:10px;">
                            <img
                                src="{{ asset('uploads/no-image.png') }}"
                                alt="Project Image"
                                class="img-thumbnail"
                                id="create-file-preview-image"
                                style="max-width:120px; height:80px; object-fit:cover;">
                        </div>

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept="image/*"
                            onchange="showCreateImageFile(event)">
                    </div>

                    <!-- Title -->
                    <div class="form-group">
                        <label>Title</label>

                        @if ($errors->has('title'))
                            <p class="text-danger">
                                {{ $errors->first('title') }}
                            </p>
                        @endif

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            value="{{ old('title') }}"
                            placeholder="Enter Project Title"
                            required>
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label>Category</label>

                        @if ($errors->has('category'))
                            <p class="text-danger">
                                {{ $errors->first('category') }}
                            </p>
                        @endif

                        <input
                            type="text"
                            name="category"
                            class="form-control"
                            value="{{ old('category') }}"
                            placeholder="e.g., AI, Backend, Portfolio">
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label>Description</label>

                        @if ($errors->has('description'))
                            <p class="text-danger">
                                {{ $errors->first('description') }}
                            </p>
                        @endif

                        <textarea
                            name="description"
                            class="form-control"
                            rows="5"
                            placeholder="Enter Project Description"
                            required>{{ old('description') }}</textarea>
                    </div>

                    <!-- Technologies -->
                    <div class="form-group">
                        <label>Technologies</label>

                        @if ($errors->has('technologies'))
                            <p class="text-danger">
                                {{ $errors->first('technologies') }}
                            </p>
                        @endif

                        <input
                            type="text"
                            name="technologies"
                            class="form-control"
                            value="{{ old('technologies') }}"
                            placeholder="e.g., JavaScript, AI">

                        <p class="help-block">Comma-separated list of technologies used.</p>
                    </div>

                    <!-- Link -->
                    <div class="form-group">
                        <label>Link (URL)</label>

                        @if ($errors->has('link'))
                            <p class="text-danger">
                                {{ $errors->first('link') }}
                            </p>
                        @endif

                        <input
                            type="url"
                            name="link"
                            class="form-control"
                            value="{{ old('link') }}"
                            placeholder="https://example.com">
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