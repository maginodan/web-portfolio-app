<div
    class="modal fade"
    id="editModal{{ $counter->id }}"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editModalLabel{{ $counter->id }}">

    <div class="modal-dialog" role="document">

        <form
            method="POST"
            action="{{ route('admin.counters.update', $counter->id) }}">

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
                        id="editModalLabel{{ $counter->id }}">
                        Edit Counter
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Number</label>

                        <input
                            type="text"
                            name="number"
                            class="form-control"
                            value="{{ $counter->number }}"
                            placeholder="e.g., 08+"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Label</label>

                        <input
                            type="text"
                            name="label"
                            class="form-control"
                            value="{{ $counter->label }}"
                            placeholder="e.g., Years<br>experience"
                            required>

                        <p class="help-block">
                            Use &lt;br&gt; where you want the line to break.
                        </p>
                    </div>

                    <div class="form-group">
                        <label>Order</label>

                        <input
                            type="number"
                            name="order"
                            class="form-control"
                            value="{{ $counter->order }}"
                            placeholder="Enter Order">
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