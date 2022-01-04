@extends('admin.admin_master')


@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Update Service</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.service' ,$services->id ) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="old_service" value="{{ asset($services->icon) }}">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Service name</label>
                                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Enter slider name" value="{{ $services->title }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlPassword">Description</label>
                                    <input type="text" name="description" class="form-control" id="exampleFormControlPassword" placeholder="Enter slider description" value="{{ $services->description }}">
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Slider file input</label>
                                    <input type="file" name="icon" class="form-control-file" id="exampleFormControlFile1" value="{{ $services->image }}">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <img src="{{ asset($services->icon) }}" >
                                </div>

                                <div class="form-footer pt-2 pt-3 mt-4 border-top">
                                    <button type="submit" class="btn btn-primary btn-default">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
