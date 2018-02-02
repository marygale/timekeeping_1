@extends('master_layout')
@section('title', (isset($user) && $user->exists()) ? "Edit User" : 'Create a user.')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(isset($user) && $user->exists())
                        {{ Form::model($user,['url' => action('UserController@update',compact('user')),'method' => 'POST']) }}
                    @else
                        {{ Form::open(['action' => 'UserController@store','method' => 'POST']) }}
                    @endif
                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::input('text', 'name', isset($user->name) ? $user->name : null , ['class' => 'form-control','id' => 'name','placeholder' => 'Enter Name']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', 'Email Address') }}
                            {{ Form::input('email', 'email', isset($user->email) ? $user->email : null, ['class' => 'form-control','id' => 'email','placeholder' => 'Enter Email']) }}
                        </div>
                        @if(!(isset($user) && $user->exists()))
                        <div class="form-group">
                            {{ Form::label('password', 'Password') }}
                            {{ Form::input('password', 'password', isset($user->password) ? $user->password : null, ['class' => 'form-control','id' => 'password','placeholder' => 'Password']) }}
                        </div>
                        @endif
                        <div class="form-group">
                            {{ Form::label('role', 'Role') }}
                            {{ Form::select('role', ["user" => "User", "admin" => "Admin"],isset($user->roles) ? $user->_roles()->first()->name : null,["class" => 'form-control',"id" => "role"]) }}
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection