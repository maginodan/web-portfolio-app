@extends('layouts.admin.base')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <h1 class="page-header">Chatbot Categories</h1>

            <a href="{{ route('admin.chatbot.categories.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Add New
            </a>
        </div>
    </div>

    @include('includes.flash_message')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">

                <div class="panel-heading">
                    List of Categories
                </div>

                <div class="panel-body">

                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="category-dataTables">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>

                                        <td>{{ $category->created_at->format('d M Y') }}</td>

                                        <td>
                                            <a href="{{ route('admin.chatbot.categories.edit', $category->id) }}"
                                            class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <button
                                                class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#deleteModal{{ $category->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Delete Confirmation Modal -->
                                    <div
                                        class="modal fade"
                                        id="deleteModal{{ $category->id }}"
                                        tabindex="-1"
                                        role="dialog"
                                        aria-labelledby="deleteModalLabel{{ $category->id }}">

                                        <div class="modal-dialog" role="document">

                                            <form
                                                method="POST"
                                                action="{{ route('admin.chatbot.categories.destroy', $category->id) }}">

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
                                                            id="deleteModalLabel{{ $category->id }}">
                                                            Confirm Delete
                                                        </h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        Are you sure you want to delete
                                                        <strong>{{ $category->name }}</strong>?
                                                        <br><br>
                                                        <span class="text-danger">Any knowledge entries in this category will be uncategorized.</span>
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
                                        <td colspan="3" class="text-center">
                                            No categories found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                        @include('includes.pagination', ['paginator' => $categories])
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
    <link href="{{ asset('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('assets/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables-responsive/js/dataTables.responsive.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#category-dataTables').DataTable({
                responsive: true,
                paging: false,
                info: false,
                ordering: false,
                searching: true
            });
        });
    </script>
@endpush