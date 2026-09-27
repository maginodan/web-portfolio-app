<div class="modal fade" id="editModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $service->id }}">
    <div class="modal-dialog" role="document">

        <form method="POST" action="{{ route('admin.services.update', $service->id) }}">
            @csrf
            @method('PATCH')

            <input type="hidden" name="page" value="{{ $services->currentPage() }}">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title" id="editModalLabel{{ $service->id }}">
                        Edit Service
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Service Name</label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ $service->name }}"
                            placeholder="Enter Service Name"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Icon (SVG)</label>

                        <div style="display: flex; align-items: stretch;">
                            <textarea
                                name="icon"
                                class="form-control"
                                rows="3"
                                style="flex: 1; resize: vertical;"
                                placeholder="Paste the complete <svg>...</svg> code here"
                                oninput="document.getElementById('service-icon-preview-{{ $service->id }}').innerHTML = this.value;"
                                required>{{ $service->icon }}</textarea>

                            <div class="well well-sm" style="display:flex;align-items:center;justify-content:center;width:46px;margin:0 0 0 8px;padding:0;">
                                <div id="service-icon-preview-{{ $service->id }}" style="width:24px;height:24px;">{!! $service->icon !!}</div>
                            </div>
                        </div>

                        <p class="help-block">Paste the complete SVG code here.</p>
                    </div>

                    <div class="form-group">
                        <label>Description</label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="5"
                            placeholder="Enter Service Description"
                            required>{{ $service->description }}</textarea>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Update
                    </button>

                </div>

            </div>
        </form>

    </div>

    <style>
        #service-icon-preview-{{ $service->id }} svg {
            width: 24px !important;
            height: 24px !important;
            max-width: 24px !important;
            max-height: 24px !important;
        }
    </style>
</div>