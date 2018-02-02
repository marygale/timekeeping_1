<?php

namespace App\Http\Controllers;

use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::all();
        return view('users_grid',compact('users'));
    }
    public function create()
    {
        return view('register');
    }
    public function store(Request $request)
    {
        $role = Role::whereName($request->role)->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>bcrypt( $request->password)
        ]);
        $user->_roles()->attach($role);
        return redirect()->action('UserController@index');
    }

    public function edit(User $user)
    {
        return view("register",compact('user'));
    }

    public function update(User $user,Request $request)
    {
        $role = Role::whereName($request->role)->first();
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        $user->_roles()->sync($role);
        return redirect()->action('UserController@index');
    }

    public function destroy(User $user)
    {
        //TODO model events
        $user->_roles()->detach();
        $user->delete();
        return redirect()->action('UserController@index')->with(["success" => "Success"]);
    }

    public function profile()
    {
        return view('profile');
    }

}
