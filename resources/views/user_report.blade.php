@extends('master_layout')
@section('title', 'User Report')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    {{ Form::open([ 'url' => action('HomeController@user_report'),'method'=> 'GET']) }}
                    <div class="row">
                        <div class="col">
                            <h3>Record Month </h3>
                        </div>
                        <div class="col">
                            {{ Form::select('month', RecordHelper::months_map,null,['class'=>'form-control custom-select form-control-lg','id' => 'month_select']) }}
                        </div>
                        <div class="col">
                            {{ Form::select('year', RecordHelper::years(),null,['class'=>'form-control custom-select form-control-lg','id' => 'year_select']) }}
                        </div>
                        <div class="col">
                            {{ Form::button('Generate', ['class'=>'btn btn-primary','type'=>'submit']) }}
                        </div>

                    </div>
                    {{ Form::close() }}

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" width="40%">User</th>
                            <th scope="col" width="40%">Project</th>
                            <th scope="col">Total Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($times as $time)
                            <tr>
                                <td scope="row">{{$time->user_name}}</td>
                                <td scope="row">{{$time->project_name}}</td>
                                <td>{{ gmdate('H:i:s',$time->total_time) }}</td>
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