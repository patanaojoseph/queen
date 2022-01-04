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
        <h2>Change Password</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('update.password') }}" method="POST" class="form-pill">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput3">Current Password</label>
                <input type="password" name="old_password" class="form-control" id="current_password" placeholder="Enter your Current password">
                @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="exampleFormControlPassword3">New Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your new password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlPassword3">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-default" style="float: right;">Save</button>


        </form>
    </div>
</div>

@endsection
