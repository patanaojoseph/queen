@extends('admin.admin_master')


@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Update Team</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.team' ,$team->id ) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="old_image" value="{{ asset($team->image) }}">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Full name</label>
                                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter full name" value="{{ $team->name }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlPassword">Position</label>
                                    <input type="text" name="position" class="form-control" id="exampleFormControlPassword" placeholder="Enter position" value="{{ $team->position }}">
                                    @error('position')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Team file input</label>
                                    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1" value="{{ $team->image }}">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <img src="{{ asset($team->image) }}" style="height: 300px; width: 300px;">
                                </div>

                                <div class="form-footer pt-2 pt-3 mt-4 border-top">
                                    <button type="submit" class="btn btn-primary btn-default" style="float: right;">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
