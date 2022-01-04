@extends('admin.admin_master')


@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Update About</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.about' ,$about->id ) }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">About Title</label>
                                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title" value="{{ $about->title }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Short Description</label>
                                    <input type="text" name="short_description" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title" value="{{ $about->short_description }}">
                                    @error('short_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Long description</label>
                                    <textarea class="form-control" name="long_description" id="exampleFormControlTextarea1" rows="3">{{ $about->long_description }}</textarea>
                                    @error('long_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-footer pt-4 pt-5 mt-4 border-top">
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
