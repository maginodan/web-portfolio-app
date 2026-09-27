<div
    class="modal fade"
    id="createModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="createModalLabel">

    <div class="modal-dialog" role="document">

        <form
            method="POST"
            action="{{ route('admin.experiences.store') }}">

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
                        Add New Experience
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Company</label>

                        @if ($errors->has('company'))
                            <p class="text-danger">
                                {{ $errors->first('company') }}
                            </p>
                        @endif

                        <input
                            type="text"
                            name="company"
                            class="form-control"
                            value="{{ old('company') }}"
                            placeholder="Enter Company Name"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Period</label>

                        @if ($errors->has('period'))
                            <p class="text-danger">
                                {{ $errors->first('period') }}
                            </p>
                        @endif

                        <input
                            type="text"
                            name="period"
                            class="form-control"
                            value="{{ old('period') }}"
                            placeholder="e.g., Jan 2020 - Dec 2022"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Position</label>

                        @if ($errors->has('position'))
                            <p class="text-danger">
                                {{ $errors->first('position') }}
                            </p>
                        @endif

                        <input
                            type="text"
                            name="position"
                            class="form-control"
                            value="{{ old('position') }}"
                            placeholder="Enter Position Held"
                            required>
                    </div>

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
                            rows="3"
                            placeholder="Enter Description">{{ old('description') }}</textarea>
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