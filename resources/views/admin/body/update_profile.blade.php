@extends('admin.admin_master')


@section('admin')

<div class="card card-default">

@if (session('success'))
<div class="alert alert-dark alert-highlighted" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

    <div class="card-header card-header-border-bottom">
        <h2>User Profile</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('update.user_profile') }}" method="POST" class="form-pill">
            @csrf

            <div class="form-group">
                <label for="exampleFormControlInput3">Username</label>
                <input type="text" name="name" class="form-control" value="{{ $user['name'] }}">

            </div>

            <div class="form-group">
                <label for="exampleFormControlInput3">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user['email'] }}">

            </div>

            <button type="submit" class="btn btn-primary btn-default" style="float: right;">Update</button>


        </form>
    </div>
</div>

@endsection

