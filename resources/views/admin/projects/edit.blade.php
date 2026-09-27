<div
    class="modal fade"
    id="editModal{{ $project->id }}"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editModalLabel{{ $project->id }}">

    <div class="modal-dialog" role="document">

        <form
            method="POST"
            action="{{ route('admin.projects.update', $project->id) }}"
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
                        id="editModalLabel{{ $project->id }}">
                        Edit Project
                    </h4>
                </div>

                <div class="modal-body">

                    <!-- Current Image -->
                    <div class="form-group">
                        <label>Current Image</label>

                        <div style="margin-top:5px;">
                            @if ($project->image)
                                <img
                                    src="{{ asset('uploads/images/' . $project->image) }}"
                                    alt="{{ $project->title }}"
                                    class="img-thumbnail"
                                    id="edit-file-preview-image-{{ $project->id }}"
                                    style="max-width:120px; height:80px; object-fit:cover;">
                            @else
                                <img
                                    src="{{ asset('uploads/no-image.png') }}"
                                    alt="No Image"
                                    class="img-thumbnail"
                                    id="edit-file-preview-image-{{ $project->id }}"
                                    style="max-width:120px; height:80px; object-fit:cover;">
                            @endif
                        </div>
                    </div>

                    <!-- Change Image -->
                    <div class="form-group">
                        <label>Change Image</label>

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
                            onchange="showEditImageFile(event, {{ $project->id }})">
                    </div>

                    <!-- Title -->
                    <div class="form-group">
                        <label>Title</label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            value="{{ $project->title }}"
                            placeholder="Enter Project Title"
                            required>
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label>Category</label>

                        <input
                            type="text"
                            name="category"
                            class="form-control"
                            value="{{ $project->category }}"
                            placeholder="e.g., AI, Backend, Portfolio">
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label>Description</label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="5"
                            placeholder="Enter Project Description"
                            required>{{ $project->description }}</textarea>
                    </div>

                    <!-- Technologies -->
                    <div class="form-group">
                        <label>Technologies</label>

                        <input
                            type="text"
                            name="technologies"
                            class="form-control"
                            value="{{ $project->technologies }}"
                            placeholder="e.g., JavaScript, AI">

                        <p class="help-block">Comma-separated list of technologies used.</p>
                    </div>

                    <!-- Link -->
                    <div class="form-group">
                        <label>Link (URL)</label>

                        <input
                            type="url"
                            name="link"
                            class="form-control"
                            value="{{ $project->link }}"
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
    function showEditImageFile(event, projectId) {
        var input = event.target;

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('edit-file-preview-image-' + projectId).src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>