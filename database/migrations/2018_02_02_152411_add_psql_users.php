<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Model\Role;
use App\Model\User;

class AddPsqlUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $user_role = Role::where('name','user')->first();
        $user_admin_role = Role::where('name','admin')->first();
        $user_super_admin_role = Role::where('name','super_admin')->first();

        $user_user = new User;
        $user_user->name = 'Coco Martin';
        $user_user->email = 'user@email.com';
        $user_user->password = bcrypt('php123');
        $user_user->remember_token = str_random(10);
        $user_user->save();


        $user_admin = new User;
        $user_admin->name = 'Dingdong Dantes';
        $user_admin->email = 'admin@email.com';
        $user_admin->password = bcrypt('php123');
        $user_admin->remember_token = str_random(10);
        $user_admin->save();


        $user_super_admin = new User;
        $user_super_admin->name = 'Piolo Pascual';
        $user_super_admin->email = 'super_admin@email.com';
        $user_super_admin->password = bcrypt('php123');
        $user_super_admin->remember_token = str_random(10);
        $user_super_admin->save();

        User::find($user_user)->_roles()->attach($user_role);
        User::find($user_admin)->_roles()->attach($user_admin_role);
        User::find($user_super_admin)->_roles()->attach($user_super_admin_role);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
