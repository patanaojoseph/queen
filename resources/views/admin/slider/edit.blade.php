@extends('admin.admin_master')


@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Update slider</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.slider' ,$sliders->id ) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="old_slider" value="{{ asset($sliders->image) }}">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Slider name</label>
                                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Enter slider name" value="{{ $sliders->title }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlPassword">Description</label>
                                    <input type="text" name="description" class="form-control" id="exampleFormControlPassword" placeholder="Enter slider description" value="{{ $sliders->description }}">
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Slider file input</label>
                                    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1" value="{{ $sliders->image }}">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <img src="{{ asset($sliders->image) }}" style="height:600px; width: 1000px;">
                                </div>

                                <div class="form-footer pt-2 pt-3 mt-4 border-top">
                                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
