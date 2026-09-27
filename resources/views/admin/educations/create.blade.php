<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">

    <div class="modal-dialog" role="document">

        <form method="POST" action="{{ route('admin.educations.store') }}">
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
                        Add New Qualification
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Institution</label>

                        @if ($errors->has('institution'))
                            <p class="text-danger">
                                {{ $errors->first('institution') }}
                            </p>
                        @endif

                        <input
                            type="text"
                            name="institution"
                            class="form-control"
                            value="{{ old('institution') }}"
                            placeholder="Enter Institution"
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
                            placeholder="e.g., 2019 - 2023"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Degree</label>

                        @if ($errors->has('degree'))
                            <p class="text-danger">
                                {{ $errors->first('degree') }}
                            </p>
                        @endif

                        <input
                            type="text"
                            name="degree"
                            class="form-control"
                            value="{{ old('degree') }}"
                            placeholder="Enter Degree"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Department</label>

                        @if ($errors->has('department'))
                            <p class="text-danger">
                                {{ $errors->first('department') }}
                            </p>
                        @endif

                        <input
                            type="text"
                            name="department"
                            class="form-control"
                            value="{{ old('department') }}"
                            placeholder="Enter Department"
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