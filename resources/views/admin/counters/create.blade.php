<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">

    <div class="modal-dialog" role="document">

        <form method="POST" action="{{ route('admin.counters.store') }}">
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
                        Add New Counter
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Number</label>

                        @if ($errors->has('number'))
                            <p class="text-danger">
                                {{ $errors->first('number') }}
                            </p>
                        @endif

                        <input
                            type="text"
                            name="number"
                            class="form-control"
                            value="{{ old('number') }}"
                            placeholder="e.g., 08+"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Label</label>

                        @if ($errors->has('label'))
                            <p class="text-danger">
                                {{ $errors->first('label') }}
                            </p>
                        @endif

                        <input
                            type="text"
                            name="label"
                            class="form-control"
                            value="{{ old('label') }}"
                            placeholder="e.g., Years<br>experience"
                            required>

                        <p class="help-block">
                            Use &lt;br&gt; where you want the line to break.
                        </p>
                    </div>

                    <div class="form-group">
                        <label>Order</label>

                        @if ($errors->has('order'))
                            <p class="text-danger">
                                {{ $errors->first('order') }}
                            </p>
                        @endif

                        <input
                            type="number"
                            name="order"
                            class="form-control"
                            value="{{ old('order', 0) }}"
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
                        class="btn btn-success">
                        <i class="fa fa-save"></i>
                        Save
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>