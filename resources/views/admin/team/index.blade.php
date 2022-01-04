@extends('admin.admin_master')



@section('admin')
    <div class="py-12">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Team Table</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" width="10%">ID no.</th>
                                        <th scope="col" width="15%">Name</th>
                                        <th scope="col" width="20%">Position</th>
                                        <th scope="col" width="20%">Image</th>
                                        <th scope="col" width="15%">Created at</th>
                                        <th scope="col" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @Php($i = 1)
                                    @foreach ($team as $teams)
                                        <tr>
                                            <td scope="row">{{ $i++ }}</td>
                                            <td>{{ $teams->name }}</td>
                                            <td>{{ $teams->position }}</td>
                                            <td><img src="{{ asset($teams->image) }}" style="height:60px; width:70px;"></td>
                                            <td>
                                                @if ( $teams->created_at == NULL )
                                                    <span class="text-danger">no date was set</span>
                                                @else
                                                    {{ $teams->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.team' ,$teams->id ) }}" class="mb-1 btn-sm btn-primary">edit</a>
                                                <a href="{{ route('delete.team' ,$teams->id ) }}" class="mb-1 btn-sm btn-danger" onclick="return confirm('Are you sure to delete this Team?')">delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="{{ route('add.team') }}"><button type="button" class="mb-1 btn active btn-primary" style="float: right;">Add Team</button></a>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


