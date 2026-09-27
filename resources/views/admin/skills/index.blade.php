@extends('layouts.admin.base')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between align-items-center">
            <h1 class="page-header">Skills</h1>

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
                    List of Skills
                </div>

                <div class="panel-body">

                    <!-- Search -->
                    <form method="GET" action="{{ route('admin.skills.index') }}" style="margin-bottom:15px;">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-8">
                                <div class="input-group">
                                    <input
                                        type="text"
                                        name="search"
                                        class="form-control"
                                        placeholder="Search Skill..."
                                        value="{{ request('search') }}">

                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Proficiency</th>
                                    <th>Service</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($skills as $skill)
                                    <tr>
                                        <td>{{ $skill->name }}</td>

                                        <td>
                                            <div class="progress" style="height:20px; margin-bottom:0;">
                                                <div
                                                    class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                    role="progressbar"
                                                    style="width: {{ $skill->proficiency }}%;"
                                                    aria-valuenow="{{ $skill->proficiency }}"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $skill->proficiency }}%
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            @if ($skill->service)
                                                {{ $skill->service->name }}
                                            @else
                                                <span class="text-muted">No Service</span>
                                            @endif
                                        </td>

                                        <td>
                                            <button
                                                class="btn btn-warning btn-sm"
                                                data-toggle="modal"
                                                data-target="#editModal{{ $skill->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <button
                                                class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#deleteModal{{ $skill->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    @include('admin.skills.edit')

                                    <!-- Delete Confirmation Modal -->
                                    <div
                                        class="modal fade"
                                        id="deleteModal{{ $skill->id }}"
                                        tabindex="-1"
                                        role="dialog"
                                        aria-labelledby="deleteModalLabel{{ $skill->id }}">

                                        <div class="modal-dialog" role="document">

                                            <form
                                                method="POST"
                                                action="{{ route('admin.skills.destroy', $skill->id) }}">

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
                                                            id="deleteModalLabel{{ $skill->id }}">
                                                            Confirm Delete
                                                        </h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        Are you sure you want to delete
                                                        <strong>{{ $skill->name }}</strong>?
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
                                            No skills found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @include('includes.pagination', ['paginator' => $skills])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.skills.create')

</div>
@endsection