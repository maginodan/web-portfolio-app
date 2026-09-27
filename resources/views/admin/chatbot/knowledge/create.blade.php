@extends('layouts.admin.base')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Knowledge Entry</h1>
        </div>
    </div>

    @include('includes.flash_message')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">

                <div class="panel-heading">
                    Knowledge Details
                </div>

                <div class="panel-body">

                    <form method="POST" action="{{ route('admin.chatbot.knowledge.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">

                                <div class="form-group">
                                    <label>Title</label>

                                    @if ($errors->has('title'))
                                        <p class="text-danger">{{ $errors->first('title') }}</p>
                                    @endif

                                    <input
                                        type="text"
                                        name="title"
                                        class="form-control"
                                        value="{{ old('title') }}"
                                        placeholder="Enter Knowledge Title"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Content</label>

                                    @if ($errors->has('content'))
                                        <p class="text-danger">{{ $errors->first('content') }}</p>
                                    @endif

                                    <textarea
                                        name="content"
                                        class="form-control"
                                        rows="8"
                                        placeholder="Enter the knowledge content the chatbot should use to answer questions"
                                        required>{{ old('content') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Keywords</label>

                                    @if ($errors->has('keywords'))
                                        <p class="text-danger">{{ $errors->first('keywords') }}</p>
                                    @endif

                                    <input
                                        type="text"
                                        name="keywords"
                                        class="form-control"
                                        value="{{ old('keywords') }}"
                                        placeholder="Comma-separated keywords, e.g. laravel, php, backend">
                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>Category</label>

                                    @if ($errors->has('category_id'))
                                        <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                    @endif

                                    <select name="category_id" class="form-control">
                                        <option value="">Uncategorized</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>

                                    @if ($errors->has('status'))
                                        <p class="text-danger">{{ $errors->first('status') }}</p>
                                    @endif

                                    <select name="status" class="form-control" required>
                                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="form-group" style="margin-top:20px;">
                            <a href="{{ route('admin.chatbot.knowledge.index') }}" class="btn btn-default">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection