@extends('master_layout')
@section('title', 'Profile')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="card">
                        <div class="card-body">
                            <div class="m-t-30">
                                <h4 class="card-title m-t-10">{{ Auth::user()->name }}</h4>
                                <h6 class="card-subtitle">{!! Auth::user()->roles !!}</h6>
                            </div>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div class="card-body">
                            <small class="text-muted">Email address </small>
                            <h6>{{ Auth::user()->email }}</h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection