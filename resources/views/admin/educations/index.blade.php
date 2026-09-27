@extends('layouts.admin.base')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <h1 class="page-header">Education Background</h1>

            <button class="btn btn-success" data-toggle="modal" data-target="#createModal">
                <i class="fa fa-plus"></i> Add New
            </button>
        </div>
    </div>

    @include('includes.flash_message')

    <!-- Table Section -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    List of Academic Qualifications
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="education-dataTables">
                            <thead>
                                <tr>
                                    <th>Institution</th>
                                    <th>Period</th>
                                    <th>Degree</th>
                                    <th>Department</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($educations as $education)
                                    <tr>
                                        <td>{{ $education->institution }}</td>

                                        <td>{{ $education->period }}</td>

                                        <td>{{ $education->degree }}</td>

                                        <td>{{ $education->department }}</td>

                                        <td>{{ Illuminate\Support\Str::limit($education->description, 60) }}</td>

                                        <td>
                                            <button
                                                class="btn btn-warning btn-sm"
                                                data-toggle="modal"
                                                data-target="#editModal{{ $education->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <button
                                                class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#deleteModal{{ $education->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    @include('admin.educations.edit')

                                    <!-- Delete Confirmation Modal -->
                                    <div
                                        class="modal fade"
                                        id="deleteModal{{ $education->id }}"
                                        tabindex="-1"
                                        role="dialog"
                                        aria-labelledby="deleteModalLabel{{ $education->id }}">

                                        <div class="modal-dialog" role="document">

                                            <form
                                                method="POST"
                                                action="{{ route('admin.educations.destroy', $education->id) }}">

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
                                                            id="deleteModalLabel{{ $education->id }}">
                                                            Confirm Delete
                                                        </h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        Are you sure you want to delete
                                                        <strong>{{ $education->institution }}</strong>
                                                        qualification?
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
                                        <td colspan="6" class="text-center">
                                            No education records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                        @include('includes.pagination', ['paginator' => $educations])
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('admin.educations.create')

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

            $('#education-dataTables').DataTable({
                responsive: true,
                paging: false,
                info: false,
                ordering: false,
                searching: true
            });

        });
    </script>

@endpush