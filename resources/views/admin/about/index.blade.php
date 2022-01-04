@extends('admin.admin_master')


@section('admin')
    <div class="py-12">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>About Table</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" width="10%">SL no.</th>
                                        <th scope="col" width="15%">About Title</th>
                                        <th scope="col" width="20%">Short Description</th>
                                        <th scope="col" width="25%">Long Description</th>
                                        <th scope="col" width="15%">Created at</th>
                                        <th scope="col" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @Php($i = 1)
                                    @foreach ($About as $about)
                                        <tr>
                                            <td scope="row">{{ $i++ }}</td>
                                            <td>{{ $about->title }}</td>
                                            <td>{{ $about->short_description }}</td>
                                            <td>{{ $about->long_description }}</td>
                                            <td>
                                                @if ( $about->created_at == NULL )
                                                    <span class="text-danger">no date was set</span>
                                                @else
                                                    {{ $about->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.about' ,$about->id ) }}" class="mb-1 btn-sm btn-primary">edit</a>
                                                <a href="{{ route('delete.about' ,$about->id ) }}" class="mb-1 btn-sm btn-danger" onclick="return confirm('Are you sure to delete this Brand?')">delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <a href="{{ route('add.about') }}"><button type="button" class="mb-1 btn active btn-primary" style="float: right;">Add About</button></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

