<?php

namespace App\Http\Controllers;

use App\Model\Time;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeController extends Controller
{

    public function store(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $request['start'] = Carbon::parse($request->start);
        $request['end'] = Carbon::parse($request->end);

        Time::create($request->all());
        return response(['message' => 'Success!!!'],200);
    }
}
