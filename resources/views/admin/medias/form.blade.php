<form method="POST" action="{{ route('medias.store') }}">
    @csrf

    <div class="row">
        {{-- Link --}}
        <div class="col-md-4">
            <div class="form-group">
                <label for="media-link">Link</label>

                {!! $errors->first('link', '<p class="text-danger">:message</p>') !!}

                <input type="text"
                    name="link"
                    id="media-link"
                    class="form-control"
                    value="{{ old('link') }}"
                    placeholder="https://facebook.com/username"
                    required>

                <p class="help-block">Full URL to the social profile.</p>
            </div>
        </div>

        {{-- Icon + live preview --}}
        <div class="col-md-6">
            <div class="form-group">
                <label for="media-icon">Icon (SVG)</label>

                {!! $errors->first('icon', '<p class="text-danger">:message</p>') !!}

                <div style="display: flex; align-items: stretch;">
                    <textarea
                        name="icon"
                        id="media-icon"
                        class="form-control"
                        rows="2"
                        style="flex: 1; resize: vertical;"
                        placeholder="Paste the complete <svg>...</svg> code here"
                        oninput="document.getElementById('icon-preview-box').innerHTML = this.value;"
                        required>{{ old('icon') }}</textarea>

                    <div class="well well-sm"
                        style="display: flex; align-items: center; justify-content: center; width: 46px; margin: 0 0 0 8px; padding: 0;">
                        <div id="icon-preview-box" style="width: 22px; height: 22px;">{!! old('icon') !!}</div>
                    </div>
                </div>

                <p class="help-block">Paste the complete SVG code here — preview shown on the right.</p>
            </div>
        </div>

        {{-- Submit --}}
        <div class="col-md-2">
            <div class="form-group">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success btn-block">
                    <i class="fa fa-plus"></i> Add
                </button>
            </div>
        </div>
    </div>

    <style>
        #icon-preview-box svg {
            width: 22px !important;
            height: 22px !important;
            max-width: 22px !important;
            max-height: 22px !important;
        }
    </style>
</form>