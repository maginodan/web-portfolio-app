@extends('layouts.admin.base')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <h1 class="page-header">Testimonials</h1>

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
                    List of Testimonials
                </div>

                <div class="panel-body">

                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="testimonials-dataTables">

                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Function</th>
                                    <th>Testimony</th>
                                    <th>Rating</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($testimonials as $testimonial)

                                    <tr>
                                        <td>
                                            @if ($testimonial->image)
                                                <img
                                                    src="{{ asset('uploads/images/' . $testimonial->image) }}"
                                                    alt="{{ $testimonial->name }}"
                                                    class="img-thumbnail"
                                                    style="width:60px; height:60px; object-fit:cover;">
                                            @else
                                                <img
                                                    src="{{ asset('uploads/avatar.png') }}"
                                                    alt="No Photo"
                                                    class="img-thumbnail"
                                                    style="width:60px; height:60px; object-fit:cover;">
                                            @endif
                                        </td>

                                        <td>
                                            {{ $testimonial->name }}
                                        </td>

                                        <td>
                                            {{ $testimonial->function }}
                                        </td>

                                        <td>
                                            {{ Str::limit($testimonial->testimony, 80) }}
                                        </td>

                                        <td>
                                            <span class="label label-success">
                                                {{ $testimonial->rating }}/5
                                            </span>
                                        </td>

                                        <td>
                                            <button
                                                class="btn btn-warning btn-sm"
                                                data-toggle="modal"
                                                data-target="#editModal{{ $testimonial->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <button
                                                class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#deleteModal{{ $testimonial->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    @include('admin.testimonials.edit')

                                    <!-- Delete Modal -->
                                    <div
                                        class="modal fade"
                                        id="deleteModal{{ $testimonial->id }}"
                                        tabindex="-1"
                                        role="dialog"
                                        aria-labelledby="deleteModalLabel{{ $testimonial->id }}">

                                        <div class="modal-dialog" role="document">

                                            <form
                                                method="POST"
                                                action="{{ route('admin.testimonials.destroy', $testimonial->id) }}">

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
                                                            id="deleteModalLabel{{ $testimonial->id }}">
                                                            Confirm Delete
                                                        </h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        Are you sure you want to delete the testimonial from
                                                        <strong>{{ $testimonial->name }}</strong>?
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
                                            No testimonials found.
                                        </td>
                                    </tr>

                                @endforelse
                            </tbody>

                        </table>
                        @include('includes.pagination', ['paginator' => $testimonials])
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    @include('admin.testimonials.create')

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

            $('#testimonials-dataTables').DataTable({
                responsive: true,
                paging: false,
                info: false,
                ordering: false,
                searching: true
            });

        });
    </script>

@endpush