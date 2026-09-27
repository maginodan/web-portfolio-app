@extends('layouts.admin.base')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <h1 class="page-header">Counters</h1>

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
                    List of Counters
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="counter-dataTables">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Label</th>
                                    <th>Order</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($counters as $counter)
                                    <tr>
                                        <td>{{ $counter->number }}</td>

                                        <td>{!! $counter->label !!}</td>

                                        <td>{{ $counter->order }}</td>

                                        <td>
                                            <button
                                                class="btn btn-warning btn-sm"
                                                data-toggle="modal"
                                                data-target="#editModal{{ $counter->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <button
                                                class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#deleteModal{{ $counter->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    @include('admin.counters.edit')

                                    <!-- Delete Confirmation Modal -->
                                    <div
                                        class="modal fade"
                                        id="deleteModal{{ $counter->id }}"
                                        tabindex="-1"
                                        role="dialog"
                                        aria-labelledby="deleteModalLabel{{ $counter->id }}">

                                        <div class="modal-dialog" role="document">

                                            <form
                                                method="POST"
                                                action="{{ route('admin.counters.destroy', $counter->id) }}">

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
                                                            id="deleteModalLabel{{ $counter->id }}">
                                                            Confirm Delete
                                                        </h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        Are you sure you want to delete the
                                                        <strong>{{ $counter->number }}</strong>
                                                        counter?
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
                                        <td colspan="4" class="text-center">
                                            No counters found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                        @include('includes.pagination', ['paginator' => $counters])
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('admin.counters.create')

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

            $('#counter-dataTables').DataTable({
                responsive: true,
                paging: false,
                info: false,
                ordering: false,
                searching: true
            });

        });
    </script>

@endpush