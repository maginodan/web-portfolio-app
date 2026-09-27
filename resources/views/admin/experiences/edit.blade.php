<div
    class="modal fade"
    id="editModal{{ $experience->id }}"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editModalLabel{{ $experience->id }}">

    <div class="modal-dialog" role="document">

        <form
            method="POST"
            action="{{ route('admin.experiences.update', $experience->id) }}">

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
                        id="editModalLabel{{ $experience->id }}">
                        Edit Experience
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Company</label>

                        <input
                            type="text"
                            name="company"
                            class="form-control"
                            value="{{ $experience->company }}"
                            placeholder="Enter Company Name"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Period</label>

                        <input
                            type="text"
                            name="period"
                            class="form-control"
                            value="{{ $experience->period }}"
                            placeholder="e.g., Jan 2020 - Dec 2022"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Position</label>

                        <input
                            type="text"
                            name="position"
                            class="form-control"
                            value="{{ $experience->position }}"
                            placeholder="Enter Position Held"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="3"
                            placeholder="Enter Description">{{ $experience->description }}</textarea>
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