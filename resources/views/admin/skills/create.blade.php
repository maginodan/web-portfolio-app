<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">

    <div class="modal-dialog" role="document">

        <form method="POST" action="{{ route('admin.skills.store') }}">
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
                        Add New Skill
                    </h4>
                </div>

                <div class="modal-body">

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
                            placeholder="Enter Skill Name"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Proficiency (%)</label>

                        @if ($errors->has('proficiency'))
                            <p class="text-danger">
                                {{ $errors->first('proficiency') }}
                            </p>
                        @endif

                        <input
                            type="number"
                            name="proficiency"
                            class="form-control"
                            value="{{ old('proficiency') }}"
                            min="0"
                            max="100"
                            placeholder="Enter Proficiency Percentage"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Service</label>

                        @if ($errors->has('service_id'))
                            <p class="text-danger">
                                {{ $errors->first('service_id') }}
                            </p>
                        @endif

                        <select
                            name="service_id"
                            class="form-control">

                            <option value="">
                                Select Service
                            </option>

                            @foreach ($services as $service)
                                <option
                                    value="{{ $service->id }}"
                                    {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach

                        </select>
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