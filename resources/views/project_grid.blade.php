@extends('master_layout')
@section('title','Projects')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @if(Session::has('success'))
                        <div class="alert alert-primary" role="alert">
                            {{ Session::get('success')}}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" width="30%">Project</th>
                            <th scope="col">Description</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td scope="row">{{$project->name}}</td>
                                    <td>{{ $project->description }}</td>
                                    <td>{!! $project->edit_button !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection