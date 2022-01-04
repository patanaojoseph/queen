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
                            <h2>Messages</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" width="6%">SL no.</th>
                                        <th scope="col" width="9%">Sender Name</th>
                                        <th scope="col" width="10%">Sender email</th>
                                        <th scope="col" width="10%">Subject</th>
                                        <th scope="col" width="10%">Message</th>
                                        <th scope="col" width="10%">Created at</th>
                                        <th scope="col" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @Php($i = 1)
                                    @foreach ($contactform as $cf)
                                        <tr>
                                            <td scope="row">{{ $i++ }}</td>
                                            <td>{{ $cf->name }}</td>
                                            <td>{{ $cf->email }}</td>
                                            <td>{{ $cf->subject }}</td>
                                            <td>{{ $cf->message }}</td>
                                            <td>
                                                @if ( $cf->created_at == NULL )
                                                    <span class="text-danger">no date was set</span>
                                                @else
                                                    {{ $cf->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.view_message' ,$cf->id ) }}" class="mb-1 btn-sm btn-primary">view</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection



