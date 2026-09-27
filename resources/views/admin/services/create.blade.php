<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
    <div class="modal-dialog" role="document">

        <form method="POST" action="{{ route('admin.services.store') }}">
            @csrf

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title" id="createModalLabel">
                        Add New Service
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Service Name</label>

                        @if ($errors->has('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            placeholder="Enter Service Name"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Icon (SVG)</label>

                        @if ($errors->has('icon'))
                            <p class="text-danger">{{ $errors->first('icon') }}</p>
                        @endif

                        <div style="display: flex; align-items: stretch;">
                            <textarea
                                name="icon"
                                class="form-control"
                                rows="3"
                                style="flex: 1; resize: vertical;"
                                placeholder="Paste the complete <svg>...</svg> code here"
                                oninput="document.getElementById('service-icon-preview-create').innerHTML = this.value;"
                                required>{{ old('icon') }}</textarea>

                            <div class="well well-sm" style="display:flex;align-items:center;justify-content:center;width:46px;margin:0 0 0 8px;padding:0;">
                                <div id="service-icon-preview-create" style="width:24px;height:24px;">{!! old('icon') !!}</div>
                            </div>
                        </div>

                        <p class="help-block">Paste the complete SVG code here.</p>
                    </div>

                    <div class="form-group">
                        <label>Description</label>

                        @if ($errors->has('description'))
                            <p class="text-danger">{{ $errors->first('description') }}</p>
                        @endif

                        <textarea
                            name="description"
                            class="form-control"
                            rows="5"
                            placeholder="Enter Service Description"
                            required>{{ old('description') }}</textarea>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Save
                    </button>

                </div>

            </div>
        </form>

    </div>

    <style>
        #service-icon-preview-create svg {
            width: 24px !important;
            height: 24px !important;
            max-width: 24px !important;
            max-height: 24px !important;
        }
    </style>
</div>