@extends('layouts.admin.base')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <h1 class="page-header">Chatbot Knowledge Base</h1>

            <a href="{{ route('admin.chatbot.knowledge.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Add New
            </a>
        </div>
    </div>

    @include('includes.flash_message')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">

                <div class="panel-heading">
                    List of Knowledge Entries
                </div>

                <div class="panel-body">

                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="knowledge-dataTables">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Keywords</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($knowledge as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>

                                        <td>
                                            @if ($item->category)
                                                <span class="label label-info">{{ $item->category->name }}</span>
                                            @else
                                                <span class="text-muted">Uncategorized</span>
                                            @endif
                                        </td>

                                        <td>{{ Illuminate\Support\Str::limit($item->keywords, 40) ?: '—' }}</td>

                                        <td>
                                            @if ($item->status === 'active')
                                                <span class="label label-success">Active</span>
                                            @else
                                                <span class="label label-default">Inactive</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.chatbot.knowledge.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <button
                                                class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#deleteModal{{ $item->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Delete Confirmation Modal -->
                                    <div
                                        class="modal fade"
                                        id="deleteModal{{ $item->id }}"
                                        tabindex="-1"
                                        role="dialog"
                                        aria-labelledby="deleteModalLabel{{ $item->id }}">

                                        <div class="modal-dialog" role="document">

                                            <form
                                                method="POST"
                                                action="{{ route('admin.chatbot.knowledge.destroy', $item->id) }}">

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
                                                            id="deleteModalLabel{{ $item->id }}">
                                                            Confirm Delete
                                                        </h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        Are you sure you want to delete
                                                        <strong>{{ $item->title }}</strong>?
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
                                            No knowledge entries found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                        @include('includes.pagination', ['paginator' => $knowledge])
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
            $('#knowledge-dataTables').DataTable({
                responsive: true,
                paging: false,
                info: false,
                ordering: false,
                searching: true
            });
        });
    </script>
@endpush