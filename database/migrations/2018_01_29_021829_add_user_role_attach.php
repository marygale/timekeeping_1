<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Model\Role;
use App\Model\User;

class AddUserRoleAttach extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        factory(User::class,3)->create();
        $user_role = Role::where('name','user')->first();
        $user_admin = Role::where('name','admin')->first();
        $user_super_admin = Role::where('name','super_admin')->first();
        User::find(1)->_roles()->attach($user_super_admin);
        User::find(2)->_roles()->attach($user_admin);
        User::find(3)->_roles()->attach($user_role);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::find(1)->_roles()->detach();
        User::find(2)->_roles()->detach();
        User::find(3)->_roles()->detach();
    }
}
