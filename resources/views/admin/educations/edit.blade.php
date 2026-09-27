<div
    class="modal fade"
    id="editModal{{ $education->id }}"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editModalLabel{{ $education->id }}">

    <div class="modal-dialog" role="document">

        <form
            method="POST"
            action="{{ route('admin.educations.update', $education->id) }}">

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
                        id="editModalLabel{{ $education->id }}">
                        Edit Qualification
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Institution</label>

                        <input
                            type="text"
                            name="institution"
                            class="form-control"
                            value="{{ $education->institution }}"
                            placeholder="Enter Institution"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Period</label>

                        <input
                            type="text"
                            name="period"
                            class="form-control"
                            value="{{ $education->period }}"
                            placeholder="e.g., 2019 - 2023"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Degree</label>

                        <input
                            type="text"
                            name="degree"
                            class="form-control"
                            value="{{ $education->degree }}"
                            placeholder="Enter Degree"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Department</label>

                        <input
                            type="text"
                            name="department"
                            class="form-control"
                            value="{{ $education->department }}"
                            placeholder="Enter Department"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="3"
                            placeholder="Enter Description">{{ $education->description }}</textarea>
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