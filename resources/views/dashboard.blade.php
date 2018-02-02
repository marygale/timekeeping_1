@extends('master_layout')
@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                        @if(Auth::user()->isUser())



                        <div class="jumbotron text-center">
                            <h1 class="display-1" id="time">00:00:00</h1>
                            <div class="row">
                                <div class="col-md-4">&nbsp;</div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{ Form::select('project', $assigned_projects,null,['class'=>'custom-select form-control-lg','id' => 'project_field']) }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><h4>Started At <span id="started_badge" class="badge badge-info"></span></h4></div>
                                        <div class="col-md-6"><h4>End At <span id="ended_badge" class="badge badge-info"></span></h4></div>
                                    </div>
                                </div>
                                <div class="col-md-4">&nbsp;</div>
                            </div>
                            <p class="lead">
                                <button type="button" class="btn btn-primary btn-lg" name="start_btn" id="start" onclick="start_timer()">Start</button>
                                <button type="button" class="btn btn-warning btn-lg" name="pause_btn" id="pause" onclick="pause_timer()">Pause</button>
                                <button type="button" class="btn btn-danger btn-lg" name="stop_btn" id="stop" onclick="stop_timer()" data-toggle="modal" data-target="#exampleModal">Stop</button>
                                <button type="button" class="btn btn-light btn-lg" name="clear_btn" id="clear" onclick="clear_timer()">Clear</button>
                                {{ Form::hidden('start_time', null, ['class' => 'form-control form-control-lg','id'=>'start_time_field']) }}
                                {{ Form::hidden('end_time', null, ['class' => 'form-control form-control-lg','id'=>'end_time_field']) }}
                            </p>
                        </div>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Project</th>
                                <th scope="col">Time Start</th>
                                <th scope="col">Time End</th>
                                <th scope="col">Total Time Spent</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($times as $time)
                            <tr>
                                <td scope="row">{{$time->project_display}}</td>
                                <td>{{$time->start_display}}</td>
                                <td>{{$time->end_display}}</td>
                                <td>{{$time->total_time_spent}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @endif

                        @if(Auth::user()->isAdmin())
                            admin
                        @endif

                        @if(Auth::user()->isSuperAdmin())
                            super admin
                        @endif

                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Save Time Logs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2>Time Spent: <span id="modal_time"></span></h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submit_action()">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>

    var time_field = document.getElementById('time'),
        seconds = 0, minutes = 0, hours = 0,
        t;

    function add() {
        seconds++;
        if (seconds >= 60) {
            seconds = 0;
            minutes++;
            if (minutes >= 60) {
                minutes = 0;
                hours++;
            }
        }

        var time_calc = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
        time_field.innerHTML = time_calc;
        $('#modal_time').html(time_calc);
        timer();
    }
    function timer() {
        t = setTimeout(add, 1000);
    }

    function pause_timer(){
        clearTimeout(t);
        var d = new Date();
        var current_time = d.getHours() +':'+d.getMinutes()+':'+d.getSeconds();

        $('#ended_badge').html(current_time)
        $('#end_time_field').val(current_time);
        $('#exampleModal').find('#modal_time_start').html(current_time);
        $('#exampleModal').find('#modal_time_end').html(current_time);
    }

    function start_timer(){
        var d = new Date();
        var current_time = d.getHours() +':'+d.getMinutes()+':'+d.getSeconds();
        $('#started_badge').html(current_time)
        $('#start_time_field').val(current_time);
        timer();
    }

    function clear_timer() {
        time_field.innerHTML = "00:00:00";
        $('#ended_badge').html("&nbsp;")
        $('#started_badge').html("&nbsp;")
        seconds = 0; minutes = 0; hours = 0;
    }
    
    function submit_action() {
        var time_val = $('#time').val();
        var started_val = $('#start_time_field').val();
        var ended_val = $('#end_time_field').val();
        var project = $('#project_field').val();

        $.ajax({
            type : 'POST',
            url : '{{action('TimeController@store')}}',
            data : {start : started_val, end : ended_val ,project_id : project},
            success : function (msg) {
                location.reload();
            }
        });
    }

</script>
@endsection