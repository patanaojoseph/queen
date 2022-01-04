@extends('admin.admin_master')


@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Update Category</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.category' ,$categories->id ) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Category name</label>
                                    <input type="text" name="category_name" class="form-control" id="exampleFormControlInput1" placeholder="Enter Category Name" value="{{ $categories->category_name }}">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
