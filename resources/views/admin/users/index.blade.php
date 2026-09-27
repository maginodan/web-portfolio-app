@extends('layouts.admin.base')

@section('content')

<div id="page-wrapper">

    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <h1 class="page-header">Users</h1>

            <button class="btn btn-success" data-toggle="modal" data-target="#createModal">
                <i class="fa fa-plus"></i> Add New
            </button>
        </div>
    </div>

    @include('includes.flash_message')

    <!-- Users Table -->
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-primary">

                <div class="panel-heading">
                    <i class="fa fa-users"></i> List of Users
                </div>

                <div class="panel-body">

                    <div class="table-responsive">

                        <table width="100%"
                               class="table table-striped table-bordered table-hover"
                               id="users-dataTables">

                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Bio</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($users as $user)

                                    <tr>

                                        <!-- Photo -->
                                        <td>
                                            @if ($user->image)
                                                <img src="{{ asset('uploads/images/' . $user->image) }}"
                                                     width="50"
                                                     height="50"
                                                     class="img-circle"
                                                     style="object-fit: cover;"
                                                     alt="{{ $user->name }}">
                                            @else
                                                <img src="{{ asset('uploads/avatar.png') }}"
                                                     width="50"
                                                     height="50"
                                                     class="img-circle"
                                                     style="object-fit: cover;"
                                                     alt="{{ $user->name }}">
                                            @endif
                                        </td>

                                        <!-- Name -->
                                        <td>
                                            <strong>{{ $user->name }}</strong>
                                        </td>

                                        <!-- Email -->
                                        <td>
                                            {{ $user->email }}
                                        </td>

                                        <!-- Bio -->
                                        <td>
                                            {{ $user->bio ? \Illuminate\Support\Str::limit($user->bio, 80) : '—' }}
                                        </td>

                                        <!-- Actions -->
                                        <td>
                                            @if (!$user->is_admin)
                                                <!-- Edit -->
                                                <button type="button"
                                                        class="btn btn-warning btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#editModal{{ $user->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <!-- Delete -->
                                                <button type="button"
                                                        class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#deleteModal{{ $user->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @else
                                                <span class="label label-info">Admin — protected</span>
                                            @endif
                                        </td>

                                    </tr>

                                    <!-- Edit Modal -->
                                    @include('admin.users.edit')

                                    <!-- Delete Modal -->
                                    <div class="modal fade"
                                         id="deleteModal{{ $user->id }}"
                                         tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="deleteModalLabel{{ $user->id }}">

                                        <div class="modal-dialog" role="document">

                                            <form method="POST"
                                                  action="{{ route('admin.users.destroy', $user->id) }}">

                                                @csrf
                                                @method('DELETE')

                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button"
                                                                class="close"
                                                                data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>

                                                        <h4 class="modal-title"
                                                            id="deleteModalLabel{{ $user->id }}">
                                                            Confirm Delete
                                                        </h4>
                                                    </div>

                                                    <div class="modal-body">

                                                        <p>
                                                            Are you sure you want to delete
                                                            <strong>{{ $user->name }}</strong>?
                                                        </p>

                                                        <p class="text-danger">
                                                            This action cannot be undone.
                                                        </p>

                                                    </div>

                                                    <div class="modal-footer">

                                                        <button type="button"
                                                                class="btn btn-default"
                                                                data-dismiss="modal">
                                                            Cancel
                                                        </button>

                                                        <button type="submit"
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
                                            <strong>No users found.</strong>
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>
                        @include('includes.pagination', ['paginator' => $users])

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

<!-- Create Modal -->
@include('admin.users.create')

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

            $('#users-dataTables').DataTable({
                responsive: true,
                paging: false,
                info: false,
                ordering: false,
                searching: true
            });

        });
    </script>

@endpush