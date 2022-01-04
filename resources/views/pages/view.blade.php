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
                            <h2>View message</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('message.delete' ,$message->id ) }}">


                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Sender name</label>
                                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter Contact Email" value="{{ $message->name }}">

                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter Contact Number" value="{{ $message->email }}">

                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Subject</label>
                                    <input type="text" name="subject" class="form-control" id="exampleFormControlInput1" placeholder="Enter Contact Address" value="{{ $message->subject }}">

                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Message</label>
                                    <textarea class="form-control" name="long_description" id="exampleFormControlTextarea1" rows="3">{{ $message->message }}</textarea>

                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Sent time</label>
                                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter Contact Email" value="{{ $message->created_at->diffForHumans() }}">

                                </div>







                                <div class="form-footer pt-2 pt-3 mt-4 border-top">
                                    <button type="submit" class="btn btn-danger btn-default" style="float: right;" onclick="return confirm('Are you sure to delete this message?')">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

