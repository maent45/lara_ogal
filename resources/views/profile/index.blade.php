@extends('templates.default')

@section('content')
    <div class="row">
        <!--- user info --->
        <div class="col-lg-6">
            @include('user.partials.userblock')
            <hr>
        </div>
        <!--- user connections --->
    </div>
@stop