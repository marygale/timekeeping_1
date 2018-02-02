<?php

namespace App\Http\Controllers;

use App\Model\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('project_grid',['projects' => Project::all()]);
    }

    public function edit(Project $project)
    {
        return view('_project',compact('project'));
    }

    public function update(Project $project,Request $request)
    {
        $request['created_by'] = Auth::user()->id;
        $project->update($request->all());
        return redirect()->action('ProjectController@index')->with(["success" => "Edited ".$project->name.""]);
    }

    public function create()
    {
        return view('_project');
    }

    public function store(Request $request)
    {
        $request['created_by'] = Auth::user()->id;
        Project::create($request->all());
        return redirect()->action('ProjectController@index')->with(["success" => "Added New Project"]);
    }
}
