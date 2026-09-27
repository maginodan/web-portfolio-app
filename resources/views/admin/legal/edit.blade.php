@extends('layouts.admin.base')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ $page->title }}</h1>
        </div>
    </div>

    @include('includes.flash_message')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file-text-o"></i> Edit Content
                </div>

                <div class="panel-body">

                    <form method="POST" action="{{ route('admin.legal.update', $page->type) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label>Page Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}">
                            {!! $errors->first('title', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" class="form-control" rows="16">{{ old('content', $page->content) }}</textarea>
                            <p class="help-block">Plain text or basic line breaks — rendered as paragraphs on the public page.</p>
                            {!! $errors->first('content', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            <label>SEO Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $page->meta_title) }}" placeholder="Leave blank to use page title">
                        </div>

                        <div class="form-group">
                            <label>SEO Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="2" maxlength="500">{{ old('meta_description', $page->meta_description) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save Changes
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection