@extends('admin.admin_master')


@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Add Team member</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('stored.team') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Full name</label>
                                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter full name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlPassword">Position</label>
                                    <input type="text" name="position" class="form-control" id="exampleFormControlPassword" placeholder="Enter position">
                                    @error('position')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Team file input</label>
                                    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-footer pt-2 pt-3 mt-4 border-top">
                                    <button type="submit" class="btn btn-primary btn-default" style="float: right;">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
