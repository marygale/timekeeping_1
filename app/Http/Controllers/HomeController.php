<?php

namespace App\Http\Controllers;

use App\Model\Role;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guest())
            return view('login');
        else{
            $times = Auth::user()->_time ? Auth::user()->_time : null;
            $assigned_projects = Auth::user()->_project()->pluck('name','id') ? Auth::user()->_project()->pluck('name','id') : null;
            return view('dashboard',compact('times','assigned_projects'));
        }
    }

    public function report(Request $request)
    {
        $month = $request->month ? $request->month : Carbon::now()->month;
        $year = $request->year ? $request->year : Carbon::now()->year;

        $times = Auth::user()->total_time_spent_report($month,$year);

        $total_time_query = collect($times)->sum('total_time');

        return view('report',['times' => $times, 'total_time_query' => $total_time_query]);
    }

    public function user_report(Request $request)
    {

        $month = $request->month ? $request->month : Carbon::now()->month;
        $year = $request->year ? $request->year : Carbon::now()->year;

//        return User::whereHas('_roles', function ($query) {
//            $query->whereName('user');
//        })->get();

        $times = DB::table('time')
            ->join('users','time.user_id','=','users.id')
            ->join('projects','time.project_id','=','projects.id')
            ->whereMonth('time.created_at','=',$month)
            ->whereYear('time.created_at', $year)
            ->select('user_id','users.name as user_name','project_id',DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(time.end, time.start))) as total_time'),'projects.name as project_name')
            ->groupBy('time.user_id','time.project_id','users.name','projects.name')
            ->get()
            ;


        return view('user_report',compact('times'));
    }
}
