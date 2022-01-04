@extends('admin.admin_master')


@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Brand Table</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">SL no.</th>
                                        <th scope="col">Brand name</th>
                                        <th scope="col">Brand image</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @Php($i = 1)
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td scope="row">{{ $i++ }}</td>
                                            <td>{{ $brand->brand_name }}</td>
                                            <td><img src="{{ asset($brand->brand_image) }}" style="height:50px; width:50px;"></td>
                                            <td>
                                                @if ( $brand->created_at == NULL )
                                                    <span class="text-danger">no date was set</span>
                                                @else
                                                    {{ $brand->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.brand' ,$brand->id ) }}" class="mb-1 btn-sm btn-primary">edit</a>
                                                <a href="{{ route('delete.brand' ,$brand->id ) }}" class="mb-1 btn-sm btn-danger" onclick="return confirm('Are you sure to delete this Brand?')">delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Add New Brand</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('add.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Brand name</label>
                                    <input type="text" name="brand_name" class="form-control" id="exampleFormControlInput1" placeholder="Enter Brand Name">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Brand image file input</label>
                                    <input type="file" name="brand_image" class="form-control-file" id="exampleFormControlFile1">
                                    @error('brand_image')
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
