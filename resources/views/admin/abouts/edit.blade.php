@extends('layouts.admin.base')

@section('content')

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">About Me</h1>
        </div>
    </div>

    @include('admin.abouts.form', ['formMode' => 'edit'])

</div>

@endsection

