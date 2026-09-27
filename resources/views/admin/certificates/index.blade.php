@extends('layouts.admin.base')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <h1 class="page-header">Certificates</h1>

            <a href="{{ route('admin.certificates.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Add New
            </a>
        </div>
    </div>

    @include('includes.flash_message')

    <!-- Table Section -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">

                <div class="panel-heading">
                    List of Certificates
                </div>

                <div class="panel-body">

                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="certificate-dataTables">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>PDF</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($certificates as $certificate)
                                    <tr>
                                        <td>
                                            @if ($certificate->image)
                                                <img
                                                    src="{{ asset('uploads/images/' . $certificate->image) }}"
                                                    alt="{{ $certificate->title }}"
                                                    class="img-thumbnail"
                                                    style="max-width:80px; height:60px; object-fit:cover;">
                                            @else
                                                <img
                                                    src="{{ asset('uploads/no-image.png') }}"
                                                    alt="No Image"
                                                    class="img-thumbnail"
                                                    style="max-width:80px; height:60px; object-fit:cover;">
                                            @endif
                                        </td>

                                        <td>{{ $certificate->title }}</td>

                                        <td>{{ Illuminate\Support\Str::limit($certificate->description, 50) }}</td>

                                        <td>
                                            @if ($certificate->pdf)
                                                <a href="{{ asset('uploads/certificates/' . $certificate->pdf) }}" target="_blank" class="btn btn-info btn-sm">
                                                    <i class="fa fa-file-pdf-o"></i> View
                                                </a>
                                                <a href="{{ asset('uploads/certificates/' . $certificate->pdf) }}" download class="btn btn-default btn-sm">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">No PDF uploaded</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.certificates.edit', $certificate->id) }}"
                                            class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <button
                                                class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#deleteModal{{ $certificate->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Delete Confirmation Modal -->
                                    <div
                                        class="modal fade"
                                        id="deleteModal{{ $certificate->id }}"
                                        tabindex="-1"
                                        role="dialog"
                                        aria-labelledby="deleteModalLabel{{ $certificate->id }}">

                                        <div class="modal-dialog" role="document">

                                            <form
                                                method="POST"
                                                action="{{ route('admin.certificates.destroy', $certificate->id) }}">

                                                @csrf
                                                @method('DELETE')

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
                                                            id="deleteModalLabel{{ $certificate->id }}">
                                                            Confirm Delete
                                                        </h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        Are you sure you want to delete
                                                        <strong>{{ $certificate->title }}</strong>?
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button
                                                            type="button"
                                                            class="btn btn-default"
                                                            data-dismiss="modal">
                                                            No
                                                        </button>

                                                        <button
                                                            type="submit"
                                                            class="btn btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                            Yes, Delete
                                                        </button>
                                                    </div>

                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            No certificates found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                        @include('includes.pagination', ['paginator' => $certificates])
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection


@push('styles')

    <!-- DataTables CSS -->
    <link href="{{ asset('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('assets/bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">

@endpush

@push('scripts')

    <!-- DataTables JavaScript -->
    <script src="{{ asset('assets/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables-responsive/js/dataTables.responsive.js') }}"></script>

    <script>
        $(document).ready(function () {

            $('#certificate-dataTables').DataTable({
                responsive: true,
                paging: false,
                info: false,
                ordering: false,
                searching: true
            });

        });
    </script>

@endpush