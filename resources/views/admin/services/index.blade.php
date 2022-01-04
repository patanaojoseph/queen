@extends('admin.admin_master')


@section('admin')
    <div class="py-12">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-default">
                        <div class="card-header card-header-border-bottom">
                            <h2>Slider Table</h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" width="10%">SL no.</th>
                                        <th scope="col" width="15%">Service name</th>
                                        <th scope="col" width="30%">Description</th>
                                        <th scope="col" width="10%">Icon</th>
                                        <th scope="col" width="20%">Created at</th>
                                        <th scope="col" width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @Php($i = 1)
                                    @foreach ($services as $service)
                                        <tr>
                                            <td scope="row">{{ $i++ }}</td>
                                            <td>{{ $service->title }}</td>
                                            <td>{{ $service->description }}</td>
                                            <td><img src="{{ asset($service->icon) }}" style="height:40px; width:50px;"></td>
                                            <td>
                                                @if ( $service->created_at == NULL )
                                                    <span class="text-danger">no date was set</span>
                                                @else
                                                    {{ $service->created_at->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.service' ,$service->id ) }}" class="mb-1 btn-sm btn-primary">edit</a>
                                                <a href=" " class="mb-1 btn-sm btn-danger" onclick="return confirm('Are you sure to delete this Brand?')">delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

            <a href="{{ route('add.service') }}"><button type="button" class="mb-1 btn active btn-primary" style="float: right;">Add new service</button></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
