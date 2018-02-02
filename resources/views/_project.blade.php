@extends('master_layout')
@section('title', (isset($project) && $project->exists()) ? "Edit project" : 'Create a project.')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(isset($project) && $project->exists())
                        {{ Form::model($project,['url' => action('ProjectController@update',compact('project')),'method' => 'POST']) }}
                    @else
                        {{ Form::open(['action' => 'ProjectController@store','method' => 'POST']) }}
                    @endif
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::input('text', 'name', isset($project->name) ? $project->name : null , ['class' => 'form-control','id' => 'name','placeholder' => 'Enter Name']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('description', 'Description') }}
                        {{ Form::input('text', 'description', isset($project->description) ? $project->description : null, ['class' => 'form-control','id' => 'email','placeholder' => 'Enter Description']) }}
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection