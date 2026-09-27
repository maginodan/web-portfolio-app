@extends('layouts.admin.base')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Category</h1>
        </div>
    </div>

    @include('includes.flash_message')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">

                <div class="panel-heading">
                    Category Details
                </div>

                <div class="panel-body">

                    <form method="POST" action="{{ route('admin.chatbot.categories.update', $category->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Name</label>

                            @if ($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $category->name) }}"
                                placeholder="Enter Category Name"
                                required>
                        </div>

                        <div class="form-group" style="margin-top:20px;">
                            <a href="{{ route('admin.chatbot.categories.index') }}" class="btn btn-default">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection