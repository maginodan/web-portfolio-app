@extends('layouts.admin.base')

@section('content')
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Message</h1>
        </div>
    </div>

    @include('includes.flash_message')

    <div class="row">

        <div class="col-lg-8">

            <div class="panel panel-primary">

                <div class="panel-heading">
                    Message Details
                </div>

                <div class="panel-body">

                    <div class="form-group">
                        <label>Name</label>

                        <p class="form-control-static">
                            {{ $message->name }}
                        </p>
                    </div>

                    <div class="form-group">
                        <label>Email</label>

                        <p class="form-control-static">
                            {{ $message->email }}
                        </p>
                    </div>

                    <div class="form-group">
                        <label>Subject</label>

                        <p class="form-control-static">
                            {{ $message->subject }}
                        </p>
                    </div>

                    <div class="form-group">
                        <label>Description</label>

                        <div class="well">
                            {{ $message->description }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="panel panel-default">

                <div class="panel-heading">
                    Message Status
                </div>

                <div class="panel-body">

                    <form
                        method="POST"
                        action="{{ route('admin.messages.update_status', $message->id) }}">

                        @csrf
                        @method('PATCH')

                        <div class="form-group">

                            <label>Status</label>

                            <div style="margin-top:10px;">

                                <div style="margin-bottom:10px;">
                                    <label style="font-weight:normal;">
                                        <input
                                            type="radio"
                                            name="status"
                                            value="1"
                                            {{ $message->status == 1 ? 'checked' : '' }}>
                                        <span class="label label-success">
                                            Read
                                        </span>
                                    </label>
                                </div>

                                <div>
                                    <label style="font-weight:normal;">
                                        <input
                                            type="radio"
                                            name="status"
                                            value="0"
                                            {{ $message->status == 0 ? 'checked' : '' }}>
                                        <span class="label label-danger">
                                            Unread
                                        </span>
                                    </label>
                                </div>

                            </div>

                        </div>

                        <hr>

                        <button
                            type="submit"
                            class="btn btn-primary btn-block">
                            <i class="fa fa-save"></i>
                            Update Message
                        </button>

                        <a
                            href="{{ route('admin.messages.index') }}"
                            class="btn btn-default btn-block"
                            style="margin-top:10px;">
                            <i class="fa fa-arrow-left"></i>
                            Back to Messages
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection