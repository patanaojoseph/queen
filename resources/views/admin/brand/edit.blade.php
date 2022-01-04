@extends('admin.admin_master')


@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Update Brand</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.brand' ,$brand->id ) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="old_image" value="{{ asset($brand->brand_image) }}">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Brand name</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleFormControlInput1" placeholder="Enter Brand Name" value="{{ $brand->brand_name }}">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Brand image file input</label>
                                    <input type="file" name="brand_image" class="form-control-file" id="exampleFormControlFile1" value="{{ $brand->brand_image }}">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <img src="{{ asset($brand->brand_image) }}" style="height:300px; width:400px;">
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
