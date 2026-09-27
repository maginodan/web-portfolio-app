@extends('layouts.admin.base')
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Medias</h1>
        </div>
    </div>


@include('includes.flash_message')

{{-- Social Media Table --}}
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-share-alt"></i> Social Media
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Link</th>
                                <th>Icon</th>
                                <th width="120">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($medias as $media)
                                <tr>
                                    <td>{{ $media->link }}</td>
                                    <td style="width: 60px;">
                                        <div style="width: 32px; height: 32px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                            <div style="width: 24px; height: 24px; overflow: hidden;">
                                                <style>
                                                    .media-preview svg {
                                                        width: 24px !important;
                                                        height: 24px !important;
                                                        max-width: 24px !important;
                                                        max-height: 24px !important;
                                                    }
                                                </style>

                                                <div class="media-preview">
                                                    {!! $media->icon !!}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-primary btn-sm"
                                            data-toggle="modal"
                                            data-target="#editSocialMediaModal{{ $media->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button type="button"
                                            class="btn btn-danger btn-sm"
                                            data-toggle="modal"
                                            data-target="#deleteSocialMediaModal{{ $media->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        No social media entries found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add New Social Media --}}
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-plus"></i> Add New Social Media
            </div>
            <div class="panel-body">
                @include('admin.medias.form')
            </div>
        </div>
    </div>
</div>

{{-- Modals --}}
@foreach ($medias as $media)

    {{-- Edit Modal --}}
    <div class="modal fade"
        id="editSocialMediaModal{{ $media->id }}"
        tabindex="-1"
        role="dialog"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('medias.update', $media->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <h4 class="modal-title">
                            <i class="fa fa-edit"></i> Edit Social Media
                        </h4>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="social-link-{{ $media->id }}">Link</label>
                            <input type="text"
                                name="link"
                                id="social-link-{{ $media->id }}"
                                class="form-control"
                                value="{{ $media->link }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="social-icon-{{ $media->id }}">Icon Class</label>
                            <textarea
                                name="icon"
                                id="social-icon-{{ $media->id }}"
                                class="form-control"
                                rows="5"
                                required>{{ $media->icon }}</textarea>

                            <p class="help-block">
                                Paste the complete SVG code here.
                            </p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-default"
                            data-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade"
        id="deleteSocialMediaModal{{ $media->id }}"
        tabindex="-1"
        role="dialog"
        aria-hidden="true">

        <div class="modal-dialog modal-sm" role="document">
            <form method="POST"
                action="{{ route('medias.destroy', $media->id) }}">

                @csrf
                @method('DELETE')

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <h4 class="modal-title">
                            Confirm Delete
                        </h4>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete this social media entry?
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-default"
                            data-dismiss="modal">
                            No
                        </button>

                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash"></i> Yes, Delete
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

  @endforeach

</div>

@endsection
