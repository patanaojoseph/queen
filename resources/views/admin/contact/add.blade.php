@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
        <div class="container">
                @if (session('success'))
                <div class="alert alert-dark alert-highlighted" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Add contact</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.contact') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter Contact Email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Contact number</label>
                                    <input type="text" name="phone" class="form-control" id="exampleFormControlInput1" placeholder="Enter Contact Number">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Contact address</label>
                                    <input type="text" name="address" class="form-control" id="exampleFormControlInput1" placeholder="Enter Contact Address">
                                    @error('address')
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

