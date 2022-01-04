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
                            <h2>Contact Data</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" width="6%">SL no.</th>
                                        <th scope="col" width="20%">Contact address</th>
                                        <th scope="col" width="10%">Contact email</th>
                                        <th scope="col" width="10%">Contact number</th>
                                        <th scope="col" width="10%">Created at</th>
                                        <th scope="col" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @Php($i = 1)
                                    @foreach ($contact as $contacts)
                                        <tr>
                                            <td scope="row">{{ $i++ }}</td>
                                            <td>{{ $contacts->address }}</td>
                                            <td>{{ $contacts->email }}</td>
                                            <td>{{ $contacts->phone }}</td>
                                            <td>
                                                @if ( $contacts->created_at == NULL )
                                                    <span class="text-danger">no date was set</span>
                                                @else
                                                    {{ $contacts->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.contacts' ,$contacts->id ) }}" class="mb-1 btn-sm btn-primary">edit</a>
                                                <a href="{{ route('delete.contacts' ,$contacts->id ) }}" class="mb-1 btn-sm btn-danger" onclick="return confirm('Are you sure to delete this Contact?')">delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="{{ route('create.contact') }}"><button type="button" class="mb-1 btn active btn-primary" style="float: right;">Create contact</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection



