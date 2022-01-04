@extends('admin.admin_master')


@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card-header card-header-border-bottom">
                        <h3>Multiple Images</h3>
                    </div>
                        <div class="card-group card-default">
                            @foreach ($image as $images)
                                <div class="col-md-4 mt-5">
                                    <div class="card">
                                        <img src="{{ asset($images->images) }}" style="height:200px; width:220px;">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Add Multiple images</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('add.images') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Multi images file input</label>
                                    <input type="file" name="image[]" class="form-control-file" id="exampleFormControlFile1" multiple=" ">
                                    @error('images')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
