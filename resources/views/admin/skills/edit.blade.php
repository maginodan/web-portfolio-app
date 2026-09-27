<div
    class="modal fade"
    id="editModal{{ $skill->id }}"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editModalLabel{{ $skill->id }}">

    <div class="modal-dialog" role="document">

        <form
            method="POST"
            action="{{ route('admin.skills.update', $skill->id) }}">

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
                        id="editModalLabel{{ $skill->id }}">
                        Edit Skill
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Name</label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ $skill->name }}"
                            placeholder="Enter Skill Name"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Proficiency (%)</label>

                        <input
                            type="number"
                            name="proficiency"
                            class="form-control"
                            value="{{ $skill->proficiency }}"
                            min="0"
                            max="100"
                            placeholder="Enter Proficiency Percentage"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Service</label>

                        <select
                            name="service_id"
                            class="form-control">

                            <option value="">
                                Select Service
                            </option>

                            @foreach ($services as $service)
                                <option
                                    value="{{ $service->id }}"
                                    {{ $skill->service_id == $service->id ? 'selected' : '' }}>
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
                        class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Update
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>